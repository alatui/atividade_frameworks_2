<?php

namespace App\Middlewares;

class Log {

    public function perform() {
        $date = date("y:m:d h:i:s");
        echo 'Log: '.$date.'<br>';
    }

}