<?php

namespace App\library;

use Exception;

class Controller {

    public function call(Route $route) {
        $controller = $route->controller;

        if(!str_contains($controller, '@')) {
            throw new Exception("Pô Vitão, esqueceu de colocar o @ no controller {$controller}");
        }
        
        [$controller, $action] = explode('@', $controller);

        $controllerInstance = 'App\\Controllers\\' . $controller;

        if(!class_exists($controllerInstance)) {
            throw new Exception("Pô Vitão, essa classe {$controller} não existe");
        }
        
        $controller = new $controllerInstance;

        if(!method_exists($controllerInstance, $action)) {
            throw new Exception("Pô Vitão, coloca o método certo!!! Esse {$action} não existe");    
        }

        // Mesma coisa que $constroller->$action();
        call_user_func_array([$controller, $action], []);
        }
}