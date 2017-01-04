<?php

// 使用するリソースを読み込む
require(__DIR__ . "/autoload.php");

// ルーティング設定
$routes = array(
    "/authorize" => [
        "viewType" => "php",
        "controller" => "AuthorizeController",
        "action" => "index"
    ],
    "/api/users/:id" => [
        "viewType" => "json",
        "controller" => "UsersApiController",
        "action" => "get"
    ],
    "/api/users" => [
        "viewType" => "json",
        "controller" => "UsersApiController",
        "action" => "index"
    ],
    "/api/reports/:year/:weeknum/:id/comments" => [
        "viewType" => "json",
        "controller" => "ReportCommentsApiController",
        "action" => "index"
    ],
    "/api/reports/:year/:weeknum/:id" => [
        "viewType" => "json",
        "controller" => "ReportsApiController",
        "action" => "get"
    ],
    "/api/reports/:year/:weeknum" => [
        "viewType" => "json",
        "controller" => "WeeklyReportsApiController",
        "action" => "index"
    ],
);

try {
    $request = new Request();
    $request->setVariables($_SERVER, $_GET, $_POST);
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