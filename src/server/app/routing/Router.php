<?php

class Router {
    
    private $routes;
    
    function __construct($routes) {
        $this->routes = $routes;
    }
    
    function route($request) {
        $route = new Route();
        $path = parse_url($request->requestUri, PHP_URL_PATH);
        
        // パスからコントローラを指定
        foreach ($this->routes as $p => $c) {
            if (preg_match('#' . $p . '#', $path, $matches) === 1) {
                $route->controller = $c['controller'];
                $route->viewType = $c['viewType'];
                
                // アクションを決定
                $left = str_replace($p, "", $path);
                if ($request->requestMethod === "GET" && ($left === "" || $left === "/")) {
                    $route->action = $c['action'];
                } else {
                    $route->action = strtolower($request->requestMethod);
                    $left = substr($left, 1);
                    if ($left) {
                        $route->param = explode("/", $left);
                    } else {
                        $route->param = array();
                    }
                }
                
                // PUT、POSTの場合eには内容データも取得
                if ($request->requestMethod === "POST" || $request->requestMethod === "PUT") {
                    $route->param[] = $request->body;
                } else {
                    parse_str(parse_url($request->requestUri, PHP_URL_QUERY), $data);
                    $route->param[] = $data;
                }
                return $route;
            }
        }
    }
}