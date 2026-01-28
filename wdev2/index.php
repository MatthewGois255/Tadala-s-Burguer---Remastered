<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Http\Response;

define('URL', 'http://localhost/vitao');

class Home {
    public static function index() {
        echo 'São Paulo vai jogar a série B';
    }
}

$obj = new Router(URL);
$obj->get('/vitao', [
    function() {
        return new Response(200, (new Home)->index());
    }
]);

$obj->run()->sendResponse();

