<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Usuario {
    private $db;
    public function __construct() {
        $this->db = Database::conectar();
    }

    function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM tbl_usuario where email_usuario = :email and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function autenticar(array $data) {
        $usuario = $this->buscarUsuarioPorEmail($data['email']);
        if (count($usuario) !== 1) {
            return false;
        }
        $usuario = $usuario[0];
        if (!password_verify($data['senha'], $usuario['senha_usuario'])) return false;

        return [
            'id' => $usuario['id_usuario'],
            'nome' => $usuario['nome_usuario']
        ];
    }
}