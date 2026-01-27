<?php

namespace App\Services;

use App\Utils\Validator;

// Responsável por centralizar 
class UserService {
    public static function create(array $data) {
        try {

            // A classe Request transforma o body do request em json num array
            // Aqui filtramos campos indesejados que podem ser passado no body, passando apenas esses três para o controller
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            return $fields;
        }
        catch(\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // public static function auth(array $data) {
    //     $fields = Validator::validate([
    //         'email' => $data['email'] ?? '',
    //         'password' => $data['password'] ?? '' 
    //     ]);

    //     $user = new Usuario->autenticar($fields);

    //     if (!$user) return ['error' => 'Não possível autenticar'];

    //     return $user;
    // }
}