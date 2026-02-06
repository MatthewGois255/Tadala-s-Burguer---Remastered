<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core {
    public static function dispatch(array $routes) {
        $url = "/";

        isset($_GET['url']) && $url .= $_GET['url'];

        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'App\\Controllers\\';

        $routerFound = false;

        foreach ($routes as $route) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';
            
            // Procura uma correspondência com a lista de rotas e extrai os parâmetros num array, se houver
            if(preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                
                $routerFound = true;

                if($route['method'] !== Request::method()) {
                    Response::json([
                        'error' => true,
                        'sucess' => false,
                        'message' => 'Sorry, method not allowed'
                    ], 405);
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);

                $controller = $prefixController . $controller;
                $extendedController = new $controller();
                $extendedController->$action(new Request, new Response, $matches);

            }
        }

        if(!$routerFound){
            $controller = $prefixController . 'NotFoundController';
            $extendedController = new $controller();
            $extendedController->index(new Request, new Response);
        }
    }
}