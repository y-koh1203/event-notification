<?php
    require './vendor/autoload.php';
    require './app/controller/OauthController.php';
    require './app/controller/UtilController.php';

    route();

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    function route(){
        // ルーティングのルールを指定
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', 'welcome');
            $r->addRoute('GET', '/twitter', 'auth');
            $r->addRoute('GET', '/twitter/callback', 'callback');
        });

        // リクエストパラメータを取得
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // リクエストURLからクエリストリング除去し、URIデコード
        $pos = strpos($uri, '?');
        if ($pos !== false) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        
        // ルーティングに従った処理を行う
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::FOUND:
                // ルーティングに従って処理を実行
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                doAction($handler, $vars);
                break;

            case FastRoute\Dispatcher::NOT_FOUND:
                // Not Found
                $util = new UtilController;
                $util->nf();
                break;

            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                // Method Not Allowed
                $allowedMethods = $routeInfo[1];
                echo "405 Method Not Allowed.  allow only=" . json_encode($allowedMethods);
                break;

            default:
                echo "500 Server Error.";
                break;
        }
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    function doAction($handler, $vars){
        switch ($handler) {
            case "welcome":
                $oauth_index = new OauthController;
                $oauth_index->index();
                break;
            case "auth":
                $oauth_index = new OauthController;
                $oauth_index->twiiterOAuth();
                break;       
            case "callback":
                $oauth_index = new OauthController;
                $oauth_index->twiiterCallback();
        }
    }
