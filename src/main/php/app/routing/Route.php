<?php

class Route {
    public $viewType;
    public $controller;
    public $action;
    public $param;
    
    function executeControllerAction() {
        $controller = new $this->controller;
        $action = $this->action;
        $controller->route = $this;
        return $controller->$action(...$this->param);
    }
}