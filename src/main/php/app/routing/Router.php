<?php

class Router {
    
    private $pathArray;
    
    function __construct($routes) {
        $this->pathArray = $routes;
    }
    
    function route() {
        $route = new Route();
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        
        // パスからコントローラを指定
        foreach ($this->pathArray as $p => $c) {
            if (preg_match('#' . $p . '#', $path, $matches) === 1) {
                $route->controller = new $c;
                
                // アクションを決定
                $left = str_replace($p, "", $path);
                if ($left === "" || $left === "/") {
                    $route->action = "index";
                } else {
                    $route->action = strtolower($_SERVER["REQUEST_METHOD"]);
                    $route->param = explode("/", substr($left, 1));
                }
                
                // PUT、POSTの場合には内容データも取得
                if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "PUT") {
                    $route->param[] = $_POST;
                } else {
                    parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $data);
                    $route->param[] = $data;
                }
                
                return $route;
            }
        }
    }
}