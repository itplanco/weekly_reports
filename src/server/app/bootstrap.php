<?php

// 使用するリソースを読み込む
require(__DIR__ . "/autoload.php");

// ルーティング設定
$routes = array(
    "/authorize" => array(
        "viewType" => "php",
        "controller" => "AuthorizeController",
        "action" => "index"
    ),
    "/api/users" => array(
        "viewType" => "json",
        "controller" => "UsersApiController",
        "action" => "index"
    ),
    "/api/reports" => array(
        "viewType" => "json",
        "controller" => "ReportsApiController",
        "action" => "index"
    )
);

try {
    $request = new Request();
    $router = new Router($routes);
    $route = $router->route($request);
    
    if (!$route) {
        header("HTTP/1.1 404 Not Found");
        exit;
    }
    
    // 権限チェック
    $authService = new AuthService();
    if (!$authService->authorize($route)) {
        throw new AuthenticationException();
    }
    
    $model = $route->executeControllerAction();
} catch (Error $e) {
    header("HTTP/1.1 500 Internal Server Error");
    $model = array("error" => $e->getMessage());
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    $model = array("error" => $e->getMessage());
}

if (!isset($route)) {
    include(__DIR__ . "/views/Error.php");
} else if($route->viewType === "json") {
    include(__DIR__ . "/views/JsonView.php");
} else {
    include(__DIR__ . "/views/" . str_replace("controller", "", strtolower($route->controller)) . "/" . $route->action . ".php");
}