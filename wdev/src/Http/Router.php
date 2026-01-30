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
    
    private function getUri(){
        $uri = $this->request->getUri();
        
        // Separa o prefixo da URI
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        
        // Retorna a URI sem o prefixo
        return end($xUri);
    }
    
    // PESQUISA NA LISTA DE ROTAS E RETORNA A ROTA CORRETA COM BASE NOS DADOS DA REQUISIÇÃO

    private function getRoute() {
        
        // Dados da requisição
        $uri = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();
        
        // VALIDAÇÃO DAS ROTAS
        foreach($this->routes as $patternRoute => $methods) {
            
            // Se a expressão regular encontrar alguma rota correspondente
            if(preg_match($patternRoute, $uri, $matches)) {
                
                // Se o método dessa rota correspondente for igual ao método da requisição
                if(isset($methods[$httpMethod])) {
                    print_r($matches);
                    exit;
                    return $methods[$httpMethod];
                }
                
                // Se a rota existir, mas o método for diferente
                throw new Exception("Vitão, cê colocou o método errado jumento", 405);
            }
        }
        
        // URI não encontrada
        throw new Exception("Aí tiozão, coloca uma URL que existe", 404);
    }
    
    public function run() {
        try{
            $route = $this->getRoute();
            
            // Verifica o controlador
            if(!isset($route['controller'])) {
                throw new Exception("O Vitão esqueceu de criar o controller", 500);
            }
            
            $args = [];

            return call_user_func_array($route['controller'], $args);
            
        } catch(Exception $e) {
            
            // Toda resposta do servidor, seja erro ou não, é uma instância dessa classe 'Response'
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    // INCLUSÃO DAS ROTAS NA LISTA DE ROTAS

    private function addRoute($method, $route, $params = []) {

        // Muda o nome da key com a Closure do controller para 'controller'
        foreach($params as $key => $value) {
            if($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // Expressão regular pra extrair os parâmetros das rotas
        $params['variables'] = [];
        
        $patternVariable = '/{(.*?)}/';

        // Retorna as correspondências de tudo que estiver entre chaves {}. Ignora se for nula
        if(preg_match_all($patternVariable, $route, $matches)){
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
            print_r($params['variables']);
            exit;
        }
        

        // Trata a barra e força a processar todo o conteúdo da rota
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        $this->routes[$patternRoute][$method] = $params;
    }

    // MÉTODOS

    public function get($route, $params = []) {
        return $this->addRoute('GET', $route, $params);
    }
    
    public function post($route, $params = []) {
        return $this->addRoute('POST', $route, $params);
    }
    
    public function put($route, $params = []) {
        return $this->addRoute('PUT', $route, $params);
    }
    
    public function delete($route, $params = []) {
        return $this->addRoute('DELETE', $route, $params);
    }
    
}