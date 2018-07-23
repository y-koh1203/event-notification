<?php
/**
 * データベース接続クラス
 * 各自必要に応じて、$dsn、$user、$passの値を自分のDB設定に合わせて変更してください。
 */

class database{
    private $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=event_notice;charset=utf8;';//左から,ホスト名,ポート番号,DB名
    private $user = 'root';// ユーザー名
    private $pass = '';//パスワード
    public $dbh; //DBハンドラ
    public $stmt; //DBステートメント

    //コンストラクタ
    // public function __construct(){ 
        
    // }
 
    /**
     * PDOクラスのインスタンスを生成する
     */
    private function openPDO(){
        try{
            $this->dbh = new PDO(
                $this->dsn, $this->user, $this->pass,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false
                )
            );

        }catch (PDOException $e){
            echo 'pdo e';
            return false;
        }

        //display errors
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $this->dbh;
    }

    /**
     * PDOの後処理
     */
    private function closePDO(){
        $this->dbh = null;
        $this->stmt = null;
    }

     /**
     * 配列の深さを検証する関数
     */
    private function arrayDepth($arr, $blank=false, $depth=0){
        if(!is_array($arr)){
            return $depth;
        } else {
            $depth++;
            $tmp = ($blank) ? array($depth) : array(0);
            foreach($arr as $value){
                $tmp[] = $this->arrayDepth($value, $blank, $depth);
            }
            return max($tmp);
        }
    }
      
    /**
     * 入力されたsqlを元にselect文を実行
     * @param string $query 入力されたsql文
     */
    public function select($query){
        $pdo = $this->openPDO();
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->closePDO();
        return $result;
    }

    /**
     * 入力されたsqlをパラメータでinsert文を実行
     * 
     * @param string $table テーブル名
     * @param array $arrColumns inertを行いたいカラム
     * @param array $arrParams カラムにinsertしたい値
     */  
    public function insert($table,$arrColumns,$arrParams){
        $pdo = $this->openPDO();

        $cntCol = count($arrColumns); //カラムの数
        $cntPar = count($arrParams); //パラメーターの数
        if(!$cntCol === $cntPar){
            $this->closePDO();
            echo 'not collect';
            return false;
        }

        $cntDepth = $this->arrayDepth($arrParams); // 配列の深さ(多次元配列かどうか)
        $cntLimit = $cntCol-1;
        $lim2 = $cntPar-1;
        $place_holder = '';
        $columns = '';
        
        //クエリの生成
        $query = 'insert into '.$table.' (';
        for($i = 0;$i < $cntCol;++$i){
            $columns .= $arrColumns[$i].',';
            $place_holder .= ':'.$arrColumns[$i].',';
            $arrBinders[] = ':'.$arrColumns[$i];
        }
        $columns = rtrim($columns,',');
        $place_holder = rtrim($place_holder,',');
        $query .= $columns;
        $query .= ') values ('.$place_holder.') ;';

        $stmt = $pdo->prepare($query);

        if($cntDepth == 1){
            for($i = 0;$i <= $cntLimit;$i++) {
                if (is_string($arrParams[$i])) {
                    $stmt->bindValue($arrBinders[$i], $arrParams[$i], PDO::PARAM_STR);
                } else if (is_int($arrParams[$i])) {
                    $stmt->bindValue($arrBinders[$i], $arrParams[$i], PDO::PARAM_INT);
                }
            }
            $stmt->execute();
        }else{
            for($i = 0;$i <= $lim2;$i++){
                for($j = 0;$j <= $cntLimit;$j++) {
                    if (is_string($arrParams[$i][$j])) {
                        $stmt->bindValue($arrBinders[$j], $arrParams[$i][$j], PDO::PARAM_STR);
                    } else if (is_int($arrParams[$i][$j])) {
                        $stmt->bindValue($arrBinders[$j], $arrParams[$i][$j], PDO::PARAM_INT);
                    }
                }
                $stmt->execute();
            }
        }
        $this->closePDO();
        return true;
    }


    /**
     * undocumented function summary
     *
     * @param string $table テーブル名
     * @param array $arrColumns updateを行いたいカラム
     * @param array $arrParams updateしたいカラムに入れる値
     * @param string $array 更新を行う対象
     **/
    public function update($table,$arrColumns,$arrParams,$target){
        $pdo = $this->openPDO();

        $cntCol = count($arrColumns); //カラムの数
        $cntPar = count($arrParams); //パラメーターの数
        if(!$cntCol === $cntPar){
            $this->closePDO();
            echo 'not collect';
            return false;
        }

        $cntDepth = $this->arrayDepth($arrParams); // 配列の深さ(多次元配列かどうか)
        $cntLimit = $cntCol-1;
        $lim2 = $cntPar-1;
        $place_holder = '';
        $columns = '';
        $whereBinder = [];
        
        //クエリの生成
        $query = 'update '.$table.' set ';
        for($i = 0;$i < $cntCol;++$i){
            $columns .= $arrColumns[$i].' =:'.$arrColumns[$i].',';
            $arrBinders[] = ':'.$arrColumns[$i];
        }
        $columns = rtrim($columns,',');
        $query .= $columns;
        $query .= ' where ';
        foreach($target as $key => $item){
            $query .= $key.' = :'.$key;
            $whereBinder[] = ':'.$key;
        }
        $query .= ' ;';

        $stmt = $pdo->prepare($query);

        if($cntDepth == 1){
            for($i = 0;$i <= $cntLimit;$i++) {
                if (is_string($arrParams[$i])) {
                    $stmt->bindValue($arrBinders[$i], $arrParams[$i], PDO::PARAM_STR);
                } else if (is_int($arrParams[$i])) {
                    $stmt->bindValue($arrBinders[$i], $arrParams[$i], PDO::PARAM_INT);
                }
            }

            foreach($target as $key => $item){
                if (is_string($item)) {
                    $stmt->bindValue($whereBinder[0], $item, PDO::PARAM_STR);
                } else if (is_int($item)) {
                    $stmt->bindValue($whereBinder[0], $item, PDO::PARAM_INT);
                }
            }
        }
        $stmt->execute();
        
        $this->closePDO();
        return true;
    }

    public function delete($table,$target){
        $pdo = $this->openPDO();
        $count_target = count($target);
        $query = "delete from {$table} where ";
        foreach($target as $key => $value){
            $query .= $key.' = :'.$key;
            $whereBinder[] = ':'.$key;
        }
        $query .= ' ;';

        $stmt = $pdo->prepare($query);

        foreach($target as $key => $item){
            if (is_string($item)) {
                $stmt->bindValue($whereBinder[0], $item, PDO::PARAM_STR);
            } else if (is_int($item)) {
                $stmt->bindValue($whereBinder[0], $item, PDO::PARAM_INT);
            }
        }
       
        $stmt->execute();

        $pdo = $this->closePDO();
        return true;
    }
} 
