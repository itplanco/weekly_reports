<?php

class Controller {

    public $route;

    function noContent() {
        header("HTTP/1.1 204 No Content");
        return;
    }

    function ok($model = NULL) {
        if ($model === NULL) {
            return $this->noContent();
        }
        return $model;
    }

    function badRequest($message) {
        header("HTTP/1.1 400 Bad Request");
        return ["error" => $message];
    }

    function notFound() {
        header("HTTP/1.1 404 Not Found");
    }
}