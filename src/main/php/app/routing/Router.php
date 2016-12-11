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
                if ($_SERVER["REQUEST_METHOD"] === "GET" && ($left === "" || $left === "/")) {
                    $route->action = "index";
                } else {
                    $route->action = strtolower($_SERVER["REQUEST_METHOD"]);
                    $left = substr($left, 1);
                    if ($left) {
                        $route->param = explode("/", $left);
                    } else {
                        $route->param = array();
                    }
                }
                
                // PUT、POSTの場合eには内容データも取得
                if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "PUT") {
                    foreach($_POST as $key => $value) { 
                        $data[$key] = $value;
                    }
                    $route->param[] = $data;
                } else {
                    parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $data);
                    $route->param[] = $data;
                }
                
                return $route;
            }
        }
    }
}