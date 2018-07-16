<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    class SearchController{

        function __construct(){
            $this->loader =  $this->loader = new Twig_Loader_Filesystem('/Applications/XAMPP/xamppfiles/htdocs/event-notification/public/templates');
            $this->twig = new Twig_Environment($this->loader);

            $this->dotenv = new Dotenv\Dotenv('/Applications/XAMPP/xamppfiles/htdocs/event-notification/');
            $this->dotenv->load();
        }

        public function returnSearchIndex(){
            echo $this->twig->render('search_connpass.html');
        }
        
        public function getConnpassUser($vars){
            $data = [];
            $data = [
                'test' => 'yamaymaa',
            ];

            echo $this->twig->render('search_result.html', $data);
        }
    }
        