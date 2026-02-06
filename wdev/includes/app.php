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

// Mapeia o apelido do middleware à sua classe

MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class,
    'required-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
    'required-admin-login' => \App\Http\Middleware\RequireAdminLogin::class
]);

MiddlewareQueue::setDefault([
    'maintenance'
]);