<?php

// 使用するリソースを読み込む
require(__DIR__ . "/routing/Router.php");
require(__DIR__ . "/routing/Route.php");
require(__DIR__ . "/controllers/Controller.php");
require(__DIR__ . "/controllers/UsersController.php");
require(__DIR__ . "/controllers/ReportsController.php");
require(__DIR__ . "/models/Models.php");
require(__DIR__ . "/models/Users.php");
require(__DIR__ . "/models/Reports.php");
require(__DIR__ . "/services/AuthService.php");
require(__DIR__ . "/views/JsonView.php");

// ルーティング設定
$routes = array(
    "/api/users" => "UsersController",
    "/api/reports" => "ReportsController"
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
    
    $view = $route->executeControllerAction();
    $view->render();
    
} catch (Error $e) {
    header("HTTP/1.1 500 Internal Server Error");
    $view = new JsonView(array("error" => $e->getMessage()));
    $view->render();
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    $view = new JsonView(array("error" => $e->getMessage()));
    $view->render();
}