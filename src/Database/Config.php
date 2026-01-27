<?php

namespace App\Database;

class Config
{
    public static function get()
    {
        return [
            'database' => array (
                'driver' => 'mysql',
                'mysql' => array (
                            'host' => '127.0.0.1',
                            'db_name' => 'tadala',
                            'username' => 'root',
                            'password' => 'root@1',
                            'charset' => 'utf8',
                            'port' => 3306,
                    ),
            )
        ];
    }
}
