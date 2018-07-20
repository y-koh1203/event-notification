<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';
    //require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/app/database.php';

    use Abraham\TwitterOAuth\TwitterOAuth;

    class SearchController{

        function __construct(){
            $this->loader =  $this->loader = new Twig_Loader_Filesystem('/Applications/XAMPP/xamppfiles/htdocs/event-notification/public/templates');
            $this->twig = new Twig_Environment($this->loader);

            $this->dotenv = new Dotenv\Dotenv('/Applications/XAMPP/xamppfiles/htdocs/event-notification/');
            $this->dotenv->load();

            //$this->pdo = new database();
        }

        // 検索画面TOPの表示
        // User情報が欲しい
        public function returnSearchIndex(){
            session_start();
             //認証チェック
             if(isset($_SESSION['auth'])){
                if($_SESSION['auth'] === false){
                    $_SESSION['err'] = '認証に失敗しました。';
                    header('Location: /error');
                    exit();
                }
            }else{
                $_SESSION['err'] = '認証をおこなってください。';
                header('Location: /error');
                exit();
            }

            echo $this->twig->render('search_connpass.html');
            exit();
        }
        
        public function getConnpassUser(){

            session_start();

            //認証チェック
            if(isset($_SESSION['auth'])){
                if($_SESSION['auth'] === false){
                    $_SESSION['err'] = '認証に失敗しました。';
                    header('Location: /error');
                    exit();
                }
            }else{
                $_SESSION['err'] = '認証をおこなってください。';
                header('Location: /error');
                exit();
            }

            //セッションからアクセストークンを取得
            $access_token = $_SESSION['access_token'];

            try{
                //OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
                $connection = new TwitterOAuth($_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }
          
            //timezone設定
            date_default_timezone_set('Asia/Tokyo');

            //現在の1日前の日時を取得
            $today = date('Y-m-d\TH:i:sP', strtotime("+ 1 day"));
            $events = [];

            //Twitter APIから、ユーザー情報を取得
            $user = $connection->get("account/verify_credentials");
            $_SESSION['screen_name'] = $user->screen_name;
            $_SESSION['id'] = $user->id;

            //file_get_contents用のユーザーエージェント
            $ua = $_SERVER['HTTP_USER_AGENT'];
            $nickname = $_GET['nickname'];
            
            //Connpass APIのエンドポイント
            $baseUrl = 'https://connpass.com';
            $url = $baseUrl.'/api/v1/event/?nickname='.$nickname;

            //file_get_contentsのオプション
            $options = [
                'http' => [
                    'method' => 'GET',
                    'header' => 'User-Agent: '.$ua,
                ],
            ];
            $context = stream_context_create($options);
            $json = file_get_contents($url, false, $context);

            $tmp_events = json_decode($json,true);

            //イベント一覧から、明日以前(今日を含む)のイベントを排除
            foreach($tmp_events['events'] as $event){
                if(strtotime($today) > strtotime($event['started_at'])){
                    continue;
                }
                $events[] = $event;
            }
    
            //テンプレートに渡すデータ
            $data = [];
            $data = [
                'test' => 'yamaymaa',
                'count' => $tmp_events['results_returned'],
                'events' => $events,
            ];

            echo $this->twig->render('search_result.html', $data);
            die();
        }

        // public function getAllmyNotice(){
        //     //セッションからアクセストークンを取得
        //     $access_token = $_SESSION['access_token'];

        //     try{
        //         //OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
        //         $connection = new TwitterOAuth($_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
        //     }catch(Exception $e){
        //         $_SESSION['err'] = '認証に失敗しました。';
        //         header('Location: /error');
        //         exit();
        //     }

        //     //Twitter APIから、ユーザー情報を取得
        //     $user = $connection->get("account/verify_credentials");

        //     $query = "select * from reminder where screen_name = {$user->screen_name} ;";
        //     $res = $this->pdo->select();
        // }
    }
        