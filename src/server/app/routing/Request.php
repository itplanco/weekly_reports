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

        if ($this->method === "PUT") {
            // PUTの場合はparse_strを使用して取得する
            parse_str(file_get_contents("php://input"), $params);
            foreach ($params as $key => $value) {
                $this->param[$key] = $value;
            }
        }
    }
}