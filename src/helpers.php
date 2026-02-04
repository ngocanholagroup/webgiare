<?php
// src/helpers.php
require_once __DIR__ . '/models/Setting.php'; 

if (!function_exists('setting')) {
    function setting($key, $default = '') {

        static $allSettings = null;

        if ($allSettings === null) {
            $model = new SettingModel();
            $allSettings = $model->getAll();
        }

        return isset($allSettings[$key]) ? $allSettings[$key] : $default;
    }
}

if (!function_exists('view')) {
    function view($viewPath, $data = []) {
        $path = str_replace('.', '/', $viewPath);
        $fullPath = __DIR__ . '/views/' . $path . '.php';
        
        if (file_exists($fullPath)) {
            extract($data);
            require $fullPath;
        } else {
            echo "View not found: $fullPath";
            die();
        }
    }
}

if (!function_exists('dd')) {
    function dd($data) {
        echo "<pre style='background:#111; color:#0f0; padding:10px; border-radius:5px; z-index:9999; position:relative;'>";
        print_r($data);
        echo "</pre>";
        die();
    }
}