<?php

namespace StudentList\config;

final class DBConnector
{
    public $connection = [
        'host' => 'localhost',
        'name' => 'users',
        'user' => 'root',                  // Настройка базы данных.
        'password' => '',
        'charset' => 'utf8mb4'
    ];
    private static $instance;

    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

}
