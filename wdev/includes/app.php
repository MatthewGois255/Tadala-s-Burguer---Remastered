<?php

require __DIR__ . '/../vendor/autoload.php';

use \App\Utils\View;
use \App\Utils\Environment;
use \App\Http\Middleware\Queue as MiddlewareQueue;

Environment::load(__DIR__ . '/../');

define('URL', getenv('URL'));

// Enviar variáveis padrões para todas as Views
View::init([
    'URL' => URL
]);

// Define o mapeamento de middlewares

MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class
]);