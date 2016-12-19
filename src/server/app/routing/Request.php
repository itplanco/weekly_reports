<?php

class Request {
    public $uri;
    public $method;
    public $param;

    function setVariables($server, $get, $post) {
        $this->uri = $server["REQUEST_URI"];
        $this->method = $server["REQUEST_METHOD"];
        $this->param = [];

        foreach($get as $key => $value) { 
            $this->param[$key] = $value;
        }

        foreach($post as $key => $value) { 
            $this->param[$key] = $value;
        }

        if ($thi->method === "PUT") {
            // PUTのデータが取れないので、インプットからデコード
            $body = file_get_contents("php://input");

            $params = explode("&", $body);
            foreach ($params as $strParam) {
                list($key, $value) = explode("=", $strParam);
                $this->param[urldecode($key)] = urldecode($value);
            }
        }
    }
}