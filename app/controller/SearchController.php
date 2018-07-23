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

            $this->pdo = new database();
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

            $access_token = $_SESSION['access_token'];
            try{
                //OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
                $connection = new TwitterOAuth($_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $user = $connection->get("account/verify_credentials");
            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }

            $_SESSION['user'] = $user;
            $data = [
                'user' => $user->screen_name
            ];

            echo $this->twig->render('search_connpass.html',$data);
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
            $cnt_events = 0;
            $index = 1;
            $offset = 1;
            if(isset($_GET['page'])){
                $index = $_GET['page'];
                $offset = (10 * $index) - 10;
            }
            $number_of_pages = 0;

            //Twitter APIから、ユーザー情報を取得
            $user = $connection->get("account/verify_credentials");
            $_SESSION['screen_name'] = $user->screen_name;
            $_SESSION['id'] = $user->id;
            $_SESSION['image_url'] = $user->profile_image_url;

            //file_get_contents用のユーザーエージェント
            $ua = $_SERVER['HTTP_USER_AGENT'];
            $nickname = $_GET['nickname'];
            $_SESSION['nickname'] = $nickname;
            
            //Connpass APIのエンドポイント
            $baseUrl = 'https://connpass.com';
            $url = $baseUrl."/api/v1/event/?nickname={$nickname}&start={$offset}&count=10";

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

            $cnt_events = count($events);
            $number_of_pages = ceil($cnt_events / 10);
    
            //テンプレートに渡すデータ
            $data = [];
            $data = [
                'count' => $tmp_events['results_returned'],
                'events' => $events,
                'nickname' => $nickname,
                'nop' => $number_of_pages,
                'user' => $user->screen_name
            ];

            echo $this->twig->render('search_result.html', $data);
            die();
        }

        public function getAllmyNotice(){

            session_start();
            //セッションからアクセストークンを取得
            $access_token = $_SESSION['access_token'];
            $nickname = '';
            if(isset($_SESSION['nickname'])){
                $nickname = $_SESSION['nickname'];
            }
            $user = $_SESSION['user'];

            try{
                //OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
                $connection = new TwitterOAuth($_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }

            //Twitter APIから、ユーザー情報を取得
            $user = $connection->get("account/verify_credentials");

            $query = "select * from reminder where screen_name = \"{$user->screen_name}\" and end = 0;";
            $res = $this->pdo->select($query);
            for($i = 0;$i < count($res);$i++){
                $time = new DateTime('@'.$res[$i]['date']);
                $time->setTimezone(new DateTimeZone('Asia/Tokyo'));
                $date_tokyo_str = $time->format('Y-m-d H:i:s');
                $res[$i]['started_at'] = $date_tokyo_str;
            }

            $data = [
                'notice' => $res,
                'nickname' => $nickname,
                'user' => $user->screen_name
            ];

            echo $this->twig->render('all_notice.html', $data);
            die();
        }

        public function delMyNotice(){

            session_start();
            //セッションからアクセストークンを取得
            $access_token = $_SESSION['access_token'];
            $nickname = $_SESSION['nickname'];
            $user = $_SESSION['user'];

            $del = $_POST['del_id'];
            $this->pdo->update('reminder',['end'],[1],['id' => $del]);

            try{
                //OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
                $connection = new TwitterOAuth($_ENV['TWITTER_API_KEY'], $_ENV['TWITTER_API_SECRET'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }

            //Twitter APIから、ユーザー情報を取得
            $user = $connection->get("account/verify_credentials");

            $query = "select * from reminder where screen_name = \"{$user->screen_name}\" and end = 0;";
            $res = $this->pdo->select($query);

            for($i = 0;$i < count($res);$i++){
                $time = new DateTime('@'.$res[$i]['date']);
                $time->setTimezone(new DateTimeZone('Asia/Tokyo'));
                $date_tokyo_str = $time->format('Y-m-d H:i:s');
                $res[$i]['started_at'] = $date_tokyo_str;
            }

            $data = [
                "notice" => $res,
                'nickname' => $nickname,
                'user' => $user->screen_name
            ];

            echo $this->twig->render('all_notice.html', $data);
            die();
        }
    }
        