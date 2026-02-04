<?php

namespace App\Controllers\Admin;

use \App\Utils\View;

class Page {
    public static function getPage($content) {
        return View::render('admin/page', [
            'content' => $content
        ]);
    }
}