<?php

class Controller {

    public $route;

    function ok($model) {
        if ($this->route->viewType === "json" && !isset($model)) {
            header("HTTP/1.1 204 No Content");
            return;
        }
        return $model;
    }

    function badRequest($message) {
        header("HTTP/1.1 400 Bad Request");
        if ($message === NULL) {
            return;
        }

        return array("error" => $message);
    }

    function notFound() {
        header("HTTP/1.1 404 Not Found");
    }
}