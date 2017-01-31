<?php

class Router {
    
    const PARAM_PATTERN = "/:[A-Za-z][A-Za-z0-9]*/";

    private $routes;
    
    function __construct($routes) {
        $this->routes = $routes;
    }
    
    function route($request) {
        $route = new Route();
        $path = parse_url($request->uri, PHP_URL_PATH);
        
        // パスからコントローラを指定
        foreach ($this->routes as $p => $c) {
            $param = $this->pathMatch($p, $path);
            if ($param !== FALSE) {
                $route->controller = $c['controller'];
                $route->viewType = $c['viewType'];

                // パラメーターを取得
                $route->param = $param;
                
                // アクションを決定
                if ($request->method === "GET") {
                    $route->action = $c['action'];
                } else {
                    $route->action = strtolower($request->method);
                }
                
                // パラメーターを設定
                if ($request->param) {
                    $route->param = $request->param;
                    foreach ($request->param as $key => $value) {
                        $route->data[$key] = $value;
                    }
                }

                if ($request->body) {
                    foreach ($request->body as $key => $value) {
                        $route->data[$key] = $value;
                    }
                }
                return $route;
            }
        }
    }
    
    private static function pathMatch($pattern, $path) {
        $rep_path = preg_replace(self::PARAM_PATTERN, "([^/]+)", $pattern);
        if (preg_match_all('#' . $rep_path . '#', $path, $value_matches, PREG_OFFSET_CAPTURE)) {
            preg_match_all(self::PARAM_PATTERN, $pattern, $key_matches);
            $param = [];
            for ($i = 0; $i < sizeof($key_matches[0]); $i++) {
                $key = str_replace(":", "", $key_matches[0][$i]);
                list($value) = $value_matches[$i + 1][0];
                $param[$key] = $value;
            }
            return $param ? $param : [];
        } else {
            return FALSE;
        }
    }
}