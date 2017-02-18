<?php

class Kernel {

    private $request;

    public function __construct(Request $request) {
        $request->dispatch();
    }

    public static function boot() {
        $request = new Request(parse_url($_SERVER['REQUEST_URI']));
        return new self($request);
    }





}