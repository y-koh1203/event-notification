<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    class OauthController{

        function __construct(){
            $this->loader =  $this->loader = new Twig_Loader_Filesystem('/Applications/XAMPP/xamppfiles/htdocs/event-notification/public/templates');
            $this->twig = new Twig_Environment($this->loader);

            $this->dotenv = new Dotenv\Dotenv('/Applications/XAMPP/xamppfiles/htdocs/event-notification/');
            $this->dotenv->load();
        }
        
        public function index (){
            $data = [];
            $data = [
                'name' => 'yamaymaa',
            ];

            echo $this->twig->render('welcome.html', $data);
            exit();
        }

        public function twiiterOAuth(){
            session_start();
            $_SESSION = [];
            $consumerKey       = $_ENV['TWITTER_API_KEY'];
            $consumerSecret    = $_ENV['TWITTER_API_SECRET'];

            $connection = new TwitterOAuth($consumerKey, $consumerSecret);

            try{
                //OAuthトークンとシークレットも使って TwitterOAuth をインスタンス化
                $connection = new TwitterOAuth($consumerKey, $consumerSecret);

            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }

            $token = $connection->oauth('oauth/request_token', array(
                'oauth_callback' => 'http://127.0.0.1:8000/twitter/callback'
            ));

            $_SESSION = array();
            $_SESSION['oauth_token'] = $token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];

            $url = $connection->url('oauth/authenticate', array(
                'oauth_token' => $token['oauth_token']
            ));

            header('Location: '.$url);
            exit();
        }

        public function twiiterCallback(){
           
            session_start();

            $consumerKey       = $_ENV['TWITTER_API_KEY'];
            $consumerSecret    = $_ENV['TWITTER_API_SECRET'];

            $request_token['oauth_token'] = $_SESSION['oauth_token'];
            $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

            //Twitterから返されたOAuthトークンと、あらかじめlogin.phpで入れておいたセッション上のものと一致するかをチェック
            if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
                die( 'Error!' );
            }

            try{
                //OAuth トークンも用いて TwitterOAuth をインスタンス化
                $connection = new TwitterOAuth($consumerKey, $consumerSecret, $request_token['oauth_token'], $request_token['oauth_token_secret']);
            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }

            try{
                //アプリでは、access_token(配列になっています)をうまく使って、Twitter上のアカウントを操作していきます
                $_SESSION['access_token'] = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
                /*
                ちなみに、この変数の中に、OAuthトークンとトークンシークレットが配列となって入っています。
                */
            }catch(Exception $e){
                $_SESSION['err'] = '認証に失敗しました。';
                header('Location: /error');
                exit();
            }

            $_SESSION['auth'] = true;
            
            header( 'location: /search');
            exit();
            //echo $this->twig->render('search_connpass.html');
        }
    }