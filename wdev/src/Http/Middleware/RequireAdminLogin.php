<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogin {
    public function handle ($request, $next) {
        
        // Impede o acesso à home do admin se ele não estiver logado
        if(!SessionAdminLogin::isLogged()) {
            $request->getRouter()->redirect('/admin/login');
        }

        return $next($request);
    }
}