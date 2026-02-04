<?php
// src/autoload.php

spl_autoload_register(function ($className) {
    // Định nghĩa các đường dẫn cơ bản map với namespace hoặc folder
    $paths = [
        '/controllers/',
        '/models/',
        '/' // Để load các file nằm ngay trong src như Router.php
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return; // Tìm thấy rồi thì dừng, không lặp nữa
        }
    }
});