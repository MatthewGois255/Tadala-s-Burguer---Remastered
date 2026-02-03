<?php

namespace App\Http\Middleware;

class Maintenance {
    public function handle ($request, $next) {
        print_r($request);
        exit;
    }
}