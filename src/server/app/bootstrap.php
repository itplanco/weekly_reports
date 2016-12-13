<?php

// 使用するリソースを読み込む
require(__DIR__ . "/routing/Router.php");
require(__DIR__ . "/routing/Route.php");
require(__DIR__ . "/controllers/Controller.php");
require(__DIR__ . "/controllers/AuthorizeController.php");
require(__DIR__ . "/controllers/UsersApiController.php");
require(__DIR__ . "/controllers/ReportsApiController.php");
require(__DIR__ . "/models/Models.php");
require(__DIR__ . "/models/Users.php");
require(__DIR__ . "/models/Reports.php");
require(__DIR__ . "/services/AuthService.php");

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
    $router = new Router($routes);
    $route = $router->route();
    
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