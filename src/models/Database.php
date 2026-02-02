<?php
// src/models/Database.php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Thông tin lấy từ docker-compose.yml của bạn
        $host = 'db'; // Tên service trong docker-compose
        $db   = 'webgiare_db';
        $user = 'user_dev';
        $pass = 'userpassword';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getConnection() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}