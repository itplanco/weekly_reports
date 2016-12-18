<?php

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {
    function testRouteEmptyParam() {
        $expected = new Route();
        $expected->viewType = "php";
        $expected->controller = "Test2Controller";
        $expected->action = "index";
        $expected->param = [];

        $request = new Request();
        $request->uri = "/test2";
        $request->method = "GET";
        $request->param = [];

        $router = new Router([
            "/test1" => [
                "viewType" => "json",
                "controller" => "Test1Controller",
                "action" => "get"
            ],
            "/test2" => [
                "viewType" => "php",
                "controller" => "Test2Controller",
                "action" => "index"
            ]
        ]);
        $actual = $router->route($request);

        $this->assertEquals($expected, $actual);
    }

    function testRouteOneUrlParam() {
        $expected = new Route();
        $expected->viewType = "php";
        $expected->controller = "Test2Controller";
        $expected->action = "index";
        $expected->param = [ "test" => "1" ];

        $request = new Request();
        $request->uri = "/test2/1";
        $request->method = "GET";
        $request->param = [];

        $router = new Router([
            "/test1/:test" => [
                "viewType" => "json",
                "controller" => "Test1Controller",
                "action" => "get"
            ],
            "/test2/:test" => [
                "viewType" => "php",
                "controller" => "Test2Controller",
                "action" => "index"
            ]
        ]);
        $actual = $router->route($request);

        $this->assertEquals($expected, $actual);
    }

    function testRouteTwoUrlParam() {
        $expected = new Route();
        $expected->viewType = "php";
        $expected->controller = "Test2Controller";
        $expected->action = "index";
        $expected->param = [ "para1" => "1", "para2" => "2" ];

        $request = new Request();
        $request->uri = "/test2/1/2";
        $request->method = "GET";
        $request->param = [];

        $router = new Router([
            "/test1/:p1/:p2" => [
                "viewType" => "json",
                "controller" => "Test1Controller",
                "action" => "get"
            ],
            "/test2/:para1/:para2" => [
                "viewType" => "php",
                "controller" => "Test2Controller",
                "action" => "index"
            ]
        ]);
        $actual = $router->route($request);

        $this->assertEquals($expected, $actual);
    }

    function testRouteTwoUrlParamFollowedByConstants() {
        $expected = new Route();
        $expected->viewType = "php";
        $expected->controller = "Test2Controller";
        $expected->action = "post";
        $expected->param = [ "para1" => "1", "para2" => "2" ];

        $request = new Request();
        $request->uri = "/test2/1/2/comments";
        $request->method = "POST";
        $request->param = [];

        $router = new Router([
            "/test1/:p1/:p2" => [
                "viewType" => "json",
                "controller" => "Test1Controller",
                "action" => "get"
            ],
            "/test2/:para1/:para2/comments" => [
                "viewType" => "php",
                "controller" => "Test2Controller",
                "action" => "index"
            ],
            "/test1/:p1/:p2" => [
                "viewType" => "html",
                "controller" => "Test3Controller",
                "action" => "put"
            ],
        ]);
        $actual = $router->route($request);

        $this->assertEquals($expected, $actual);
    }
}