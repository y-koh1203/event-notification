<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';

    class UtilController{

        function __construct(){
            $this->loader =  $this->loader = new Twig_Loader_Filesystem('/Applications/XAMPP/xamppfiles/htdocs/event-notification/public/templates');
            $this->twig = new Twig_Environment($this->loader);
        }
        
        public function nf (){
            echo $this->twig->render('404.html');
            exit();
        }

        public function error(){
            session_start();
            $msg = $_SESSION['err'];
            $data = [
                'msg' => $msg
            ];
            echo $this->twig->render('error.html',$data);
            $_SESSION = [];
            exit();
        }
    }