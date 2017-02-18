<?php

class Controller {

    private $name;
    private $action;
    private $refInstance;
    private $instance;
    private $fullClassName;

    public function __construct($name, $action) {
        $this->name = ucfirst($name);
        $this->action = $action;
        $this->reflect();
    }


    public function reflect() {
        $this->fullClassName = '\\App\\Controllers\\'.$this->name;
        if(class_exists($this->fullClassName)) {
            $this->refInstance =  new ReflectionClass($this->fullClassName);
            $this->instance = $this->refInstance->newInstance();
        }
    }

    public function dispatchAction() {
        if($this->refInstance->hasMethod($this->action)) {
            $this->dispatchMiddlewares();
        } else {
            throw new Exception('Action not found.');
        }
        $reflectionMethod = new ReflectionMethod($this->fullClassName, $this->action);
        return $reflectionMethod->invoke($this->instance);
    }

    private function dispatchMiddlewares() {
        if(!$this->refInstance->hasProperty('middlewares')) {
            return;
        }
        $propMiddlewares = $this->refInstance->getProperty('middlewares');
        $propMiddlewares->setAccessible(true);

        $middlewares = $propMiddlewares->getValue($this->instance);
        if(!isset($middlewares[$this->action])) { return; }
        foreach($middlewares[$this->action] as $m) {
            $this->executeMiddleware($m);
        }
    }

    private function executeMiddleware($name) {
        $class = 'App\\Middlewares\\'.ucfirst($name);
        $middleware = new $class;
        $middleware->perform();
    }





}