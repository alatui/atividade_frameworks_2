<?php

namespace App\Controllers;

class Products {

    private $middlewares = [
        'index' => ['post'],
        'delete' => ['log']
    ];

    public function index() {
        echo 'usuários';
    }

    public function delete() {
        echo 'produto excluido';
    }

}