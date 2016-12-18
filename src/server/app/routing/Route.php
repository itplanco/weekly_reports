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

        $methodInfo = new ReflectionMethod($this->controller, $action);
        $paramArgs = [];
        foreach($methodInfo->getParameters as $param) {
            $paramArgs[] = $this->param[$param->name];
        }
        return $controller->$action(...$paramArgs);
    }
}