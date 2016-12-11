<?php

class Controller {

    function ok($model) {
        if ($model === NULL) {
            header("HTTP/1.1 204 No Content");
            return new JsonView();
        }
        return new JsonView($model);
    }

    function badRequest($message) {
        header("HTTP/1.1 400 badRequest");
        if ($message === NULL) {
            return new JsonView();
        }

        return new JsonView(array("error" => $message));
    }

    function notFound() {
        header("HTTP/1.1 404 Not Found");
        return new JsonView();
    }
}