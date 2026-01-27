<?php

namespace App\library;

use Closure;

class Router {
    private array $routes = [];

    public function add(string $uri, string $request, string $controller) {
        $this->routes[] = new Route($uri, $request, $controller);
    }

    public function group(array $routeOptions, Closure $callback) {
        $callback->call($this);
    }

    public function init() {
        foreach($this->routes as $route) {
            if($route->match($route)) return (new Controller)->call($route);

            return (new Controller)->call(new Route('/404', 'GET', 'NotFoundController:index'));
        }
    }
}