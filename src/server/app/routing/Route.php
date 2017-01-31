<?php

class Route {
    public $viewType;
    public $controller;
    public $action;
    public $param;
    public $data;
    
    function executeControllerAction() {
        $controller = new $this->controller;
        $action = $this->action;
        $controller->route = $this;

        $methodInfo = new ReflectionMethod($this->controller, $action);
        $paramArgs = [];
        foreach($methodInfo->getParameters() as $param) {
            if(isset($this->param[$param->name])) {
                $paramArgs[] = $this->param[$param->name];
            } else {
                $paramArgs[] = $this->data[$param->name];
            }
        }
        return $controller->$action(...$paramArgs);
    }
}