<?php

class Request {

    private $query;
    private $controller;
    private $action;

    public function __construct($req) {
        $this->query = isset($req['query']) ? $req['query'] : [];
        $this->parsePath($req['path']);
    }


    private function parsePath($path) {
        if($path == '/') {
            $this->controller = 'index';
            $this->action = 'index';
            return;
        }
        $path = explode('/', $path);
        $this->controller = $path[1];
        $this->action = isset($path[2]) ? $path[2] :'index';
    }


    public function __toString() {
        return 'Controller: '.$this->controller.', Action: '.$this->action.', Method: '.$this->type;
    }

    public function dispatch() {
        $controller = new Controller($this->controller, $this->action);
        return $controller->dispatchAction();
    }

}