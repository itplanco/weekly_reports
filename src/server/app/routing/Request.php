<?php

class Request {
    public $uri;
    public $method;
    public $param;
    public $body;
    
    function setVariables($server, $get, $post) {
        $this->uri = $server["REQUEST_URI"];
        $this->method = $server["REQUEST_METHOD"];
        $this->param = [];
        $this->body = [];
        
        foreach($get as $key => $value) {
            $this->param[$key] = $value;
        }
        
        if ($server["CONTENT_TYPE"] == "application/json") {
            $this->body = (array) json_decode(file_get_contents("php://input"));
        } else {
            foreach($post as $key => $value) {
                $this->body[$key] = $value;
            }

            if ($this->method === "PUT") {
                // PUTの場合はparse_strを使用して取得する
                parse_str(file_get_contents("php://input"), $params);
                foreach ($params as $key => $value) {
                    $this->body[$key] = $value;
                }
            }
        }
    }
}