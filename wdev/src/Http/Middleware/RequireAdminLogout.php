<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogout {
    public function handle ($request, $next) {
        
        // Verifica se o usuário está logado antes de acessar a tela de login e redireciona para a home do admin
        if(SessionAdminLogin::isLogged()) {
            $request->getRouter()->redirect('/admin');
        }

        return $next($request);
    }
}