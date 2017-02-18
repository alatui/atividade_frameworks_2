<?php

spl_autoload_register(function($class_path) {
    $class = strtolower($class_path).'.php';

    if(strpos($class,'app\controllers') !== false) {

        $class = explode('\\', $class);
        require_once(getcwd().'/../controllers/'.end($class));

    } else if(strpos($class,'app\middlewares') !== false) {

        $class = explode('\\', $class);
        require_once(getcwd().'/../middlewares/'.end($class));

    } else {

        require_once(getcwd().'/../lib/'.$class);

    }

});

Kernel::boot();