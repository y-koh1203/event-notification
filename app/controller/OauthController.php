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
        }

        public function twiiterOAuth(){
            $consumerKey       = $_ENV['TWITTER_API_KEY'];
            $consumerSecret    = $_ENV['TWITTER_API_SECRET'];

            $connection = new TwitterOAuth($consumerKey, $consumerSecret);

            $token = $connection->oauth('oauth/request_token', array(
                'oauth_callback' => 'http://127.0.0.1:8000/twitter/callback'
            ));

            if(!isset($_SESSION)){
                session_start();
                $_SESSION['oauth_token'] = $token['oauth_token'];
                $_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];
            }

            $url = $connection->url('oauth/authenticate', array(
                'oauth_token' => $token['oauth_token']
            ));

            header('Location: '.$url);
        }

        public function twiiterCallback(){
            echo $this->twig->render('search_connpass.html');
        }
    }