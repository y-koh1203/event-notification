<?php
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';

    class UtilController{

        function __construct(){
            $this->loader =  $this->loader = new Twig_Loader_Filesystem('/Applications/XAMPP/xamppfiles/htdocs/event-notification/public/templates');
            $this->twig = new Twig_Environment($this->loader);
        }
        
        public function nf (){
            $data = [];
            $data = [
                'name' => 'yamaymaa',
            ];

            echo $this->twig->render('404.html', $data);
        }
    }