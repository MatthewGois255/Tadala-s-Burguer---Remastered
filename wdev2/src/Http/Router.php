<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router {
    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;

    public function __construct($url) {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    private function setPrefix() {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method, $route, $params = []) {
        foreach($params as $key => $value) {
            if($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        $this->routes[$patternRoute][$method] = $params;
    }

    private function getUri(){
        $uri = $this->request->getUri();
        
        // Separa o prefixo da URI
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        
        // Retorna a URI sem o prefixo
        return end($xUri);
    }

    private function getRoute() {
        // URI
        $uri = $this->getUri();

        // Method
        $httpMethod = $this->request->getHttpMethod();
        
        
        print_r($httpMethod);
        exit;
    }

    public function run() {
        try{
            $route = $this->getRoute();
            print_r($route);

            //throw new Exception("Palmeiras não tem mundial", 404);
        } catch(Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    public function get($route, $params = []) {
        return $this->addRoute('GET', $route, $params);
    }
}