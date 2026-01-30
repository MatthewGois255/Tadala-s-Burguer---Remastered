<?php

namespace App\Utils;

class View {
    private static $vars = [];

    public static function init($vars = []) {
        self::$vars = $vars;
    }

    private static function getContentView($view) {
        $file = __DIR__ . "/../../resources/view/" . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }
    public static function render($view, $vars = []) {
        $contentView = self::getContentView($view);

        $vars = array_merge(self::$vars, $vars);

        // Cria um array das chaves do array $vars
        $keys = array_keys($vars);

        // Executa uma função pra cada chave do array de chaves (que são os nomes das variáveis a serem usadas no HTML) e retorna um array com elas tratadas
        $keys = array_map(function($item) {
            return '{{' . $item . '}}';
        }, $keys);

        // Pra cada valor em 'array_values($vars)', substitui na página HTML pelo nome da variável no index correspondente em '$keys'
        return str_replace($keys, array_values($vars), $contentView);
    }
}