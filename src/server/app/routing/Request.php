<?php

class Request {
    public $uri;
    public $method;
    public $body;

    function __construct() {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->body = [];
        foreach($_POST as $key => $value) { 
            $this->body[$key] = $value;
        }
    }
}