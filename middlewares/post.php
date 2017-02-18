<?php

namespace App\Middlewares;

class Post {

    public function perform() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            exit('Only POST method is allowed');
        }
    }

}