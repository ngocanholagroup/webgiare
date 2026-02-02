<?php
// src/controllers/AdminController.php

require_once __DIR__ . '/../models/Database.php'; // Tạm thời require thủ công nếu chưa có autoload

class AdminController {
    public function dashboard() {
        view('admin.dashboard', [
            'title' => 'Bảng điều khiển Admin'
        ]);
    }
}
