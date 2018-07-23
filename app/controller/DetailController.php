<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/app/database.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    class DetailController{

        function __construct(){
            $this->loader =  $this->loader = new Twig_Loader_Filesystem('/Applications/XAMPP/xamppfiles/htdocs/event-notification/public/templates');
            $this->twig = new Twig_Environment($this->loader);

            $this->dotenv = new Dotenv\Dotenv('/Applications/XAMPP/xamppfiles/htdocs/event-notification/');
            $this->dotenv->load();

            $this->pdo = new database();
        }
        
        public function detailIndex(){
            session_start();

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

            $_SESSION['event'] = [];
            $nickname = $_SESSION['nickname'];
            $event_id = $_GET['event_id'];
            $user = $_SESSION['user'];

            //file_get_contents用のユーザーエージェント
            $ua = $_SERVER['HTTP_USER_AGENT'];
            
            //Connpass APIのエンドポイント
            $baseUrl = 'https://connpass.com';
            $url = $baseUrl.'/api/v1/event/?event_id='.$event_id;

            //file_get_contentsのオプション
            $options = [
                'http' => [
                    'method' => 'GET',
                    'header' => 'User-Agent: '.$ua,
                ],
            ];
            $context = stream_context_create($options);
            $json = file_get_contents($url, false, $context);

            $event = json_decode($json,true);

            $_SESSION['event'] = $event['events'][0];

            $data = [
                'event' => $event['events'][0],
                'nickname' => $nickname,
                'user' => $user->screen_name
            ];

            echo $this->twig->render('event_detail.html',$data);
            exit();
        }

        public function setNotice(){
            session_start();

            $event = $_SESSION['event'];
            $notice_date = $_POST['notice_date'];
            $nickname = $_SESSION['nickname'];
            $msg = "";

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

            //Twitter APIから、ユーザー情報を取得
            $user = $connection->get("account/verify_credentials");

            //重複リマインドの検出
            $select_res = $this->pdo->select(
                "select * from reminder where event_id = {$event['event_id']} and screen_name = \"{$user->screen_name}\" and notice_date = {$notice_date} and end = 0 ;"
            );

            //重複に該当しない場合のみinsert
            if(!count($select_res) > 0){
                $res = $this->pdo->insert(
                    'reminder',
                    ['event_id','screen_name','event_name','date','url','notice_date','end'],
                    [$event['event_id'],$user->screen_name,$event['title'],strtotime($event['started_at']),$event['event_url'],$notice_date,0]
                );
            }else{
                $res = false;
                $msg = 'そのリマインドは登録済みです。';
            }

            $data = [
                'res' => $res,
                'event_id' => $event['event_id'],
                'nickname' => $nickname,
                'message' => $msg,
                'user' => $user->screen_name
            ];

            echo $this->twig->render('result.html',$data);
            exit();
        }
    }