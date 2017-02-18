<?php

namespace App\Controllers;

class Users {

    private $middlewares = [
        'index' => ['post']
    ];

    public function index() {
        echo 'usuários';
    }

}