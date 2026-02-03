<?php

namespace App\Http\Middleware;

class Queue {
    // Fila de middlewares a serem executados
    private $middleware = [];
    private $controller;
    private $controllerArgs =  [];

    public function __construct($middleware, $controller, $controllerArgs)
    {
        $this->middleware = $middleware;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

}