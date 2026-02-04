<?php

namespace App\Http\Middleware;

class Maintenance {
    public function handle ($request, $next) {

        // Verifica o estado de manutenção da página
        if(getenv('MAINTENANCE') == 'true') {
            throw new \Exception("Página em manutenção. Tente novamente mais tarde.", 200);
        }
        
        return $next($request);
    }
}