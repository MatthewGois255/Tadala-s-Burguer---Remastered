<?php

namespace App\Controllers\Admin;

use \App\Utils\View;
use \App\Session\Admin\Login as SessionAdminLogin;

class Login extends Page {

    public static function getLogin($request, $errorMessage = null) { // A mensagem de erro vem do método que busca o email no banco de dados e valida se retornou um usuário válido (31:00 no vídeo 5)
        $status = !is_null($errorMessage) ? View::render('admin/login/status', [
            'mensagem' => $errorMessage
        ]) : '';

        $content = View::render('admin/login', [
            'status' => $status
        ]);
        
        return parent::getPage($content);
    }

    // Depois de validar as variáveis com o banco de dados, o banco retorna o id, nome, email e senha
    // Enviamos esses dados para a classe de Session\Login
    // Com a variável $request, nós acessamos o Router ( $request->getRouter()->redirect('/admin') ) pra redirecionar ele pra home do admin

    public static function setLogout($request) {
        // Destroi a sessão de login
        SessionAdminLogin::logout();

        //Redireciona o usuário para a tela de login
        $request->getRouter()->redirect('/admin/login');
    }
}