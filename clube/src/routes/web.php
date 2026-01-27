<?php

try{
    $router->group(['prefix' => 'admin', 'controller' => 'admin', 'middlewares' => []], function() {
        $this->add('/teste', 'GET', 'TesteController@index');
    });
    
    $router->add('/', 'GET', 'HomeController@index');
    $router->init();
}catch(Exception $e){
    echo $e->getMessage() . '<br>';
    echo($e->getFile() . "   Line " . $e->getLine());
}