<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Http\Response;
use \App\Utils\View;

define('URL', 'http://localhost/vitao');

// Enviar variáveis padrões para todas as Views
View::init([
    'URL' => URL
]);


$obj = new Router(URL);

// Inclui as rotas
include __DIR__ . '/src/routes/pages.php';

$obj->run()->sendResponse();