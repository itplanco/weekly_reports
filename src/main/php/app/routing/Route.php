<?php

class Route {
    public $controller;
    public $action;
    public $param;
    
    function executeControllerAction() {
        $controller = $this->controller;
        $action = $this->action;
        return $controller->$action(...$this->param);
    }
}