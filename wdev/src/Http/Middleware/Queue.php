<?php

namespace App\Http\Middleware;

class Queue {

    // Mapeamento dos middlewares
    private static $map = [];

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

    public static function setMap($map) {
        self::$map = $map;
    }

    // Executa o próximo nível da fila de middlewares
    public function next($request) {
        print_r($this);
        exit;
    }
}