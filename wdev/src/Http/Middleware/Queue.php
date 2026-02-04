<?php

namespace App\Http\Middleware;

use Exception;

class Queue {

    // Mapeamento dos middlewares
    private static $map = [];
    
    // Mapeamento dos middlewares que vão ser carregados em toda a aplicação
    private static $default = [];

    // Fila de middlewares a serem executados
    private $middleware = [];
    private $controller;
    private $controllerArgs =  [];

    public function __construct($middleware, $controller, $controllerArgs)
    {
        // Coloca os middlewares padrões para serem executados primeiro lista
        $this->middleware = array_merge(self::$default, $middleware);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    public static function setMap($map) {
        self::$map = $map;
    }

    public static function setDefault($default) {
        self::$default = $default;
     }

    // Executa o próximo nível da fila de middlewares
    public function next($request) {
        
        // Verifica se a fila está vazia
        if(empty($this->middleware))
            return call_user_func_array($this->controller, $this->controllerArgs);

        // Pega o próximo middleware da lista que vai ser executado
        $middleware = array_shift($this->middleware);

        // Valida se o mapeamento possui esse middleware
        if(!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o middleware da requisição", 500);
        }

        $next = function($request) {
            return $this->next($request);
        };

        // Executa o middleware
        return (new self::$map[$middleware])->handle($request, $next);
    }
}