<?php

class Request {
    public $requestUri;
    public $requestMethod;
    public $requestBody;

    function __construct() {
        $this->requestUri = $_SERVER["REQUEST_URI"];
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
        $this->requestBody = [];
        foreach($_POST as $key => $value) { 
            $this->requestBody[$key] = $value;
        }
    }
}