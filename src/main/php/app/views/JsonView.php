<?php

class JsonView {
    public $model;
    
    function __construct($model) {
        $this->model = $model;
    }
    
    function render() {
        header("Content-Type: application/json");
        if ($this->model === NULL) {
            print "{}";
            return;
        }

        print json_encode($this->model);
    }
}