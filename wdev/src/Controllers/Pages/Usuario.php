<?php

namespace App\Controllers\Pages;

use App\Utils\View;

class Usuario extends Page {
    public static function getUsuario($id) {
        $content = View::render('pages/usuario', [
            'id' => $id
        ]);
        return parent::getPage("Texto para passar no h1", $content);
    }
}