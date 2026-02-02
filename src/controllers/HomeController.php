<?php
// src/controllers/HomeController.php

class HomeController {
    public function index() {
        // Gọi view thông qua hàm helper (sẽ định nghĩa ở index)
        view('client.home', [
            'title' => 'Trang chủ Web Giá Rẻ (MVC)'
        ]);
    }

    public function about() {
        view('client.about', ['title' => 'Về chúng tôi']);
    }

    public function services() {
        view('client.services', ['title' => 'Dịch vụ']);
    }

    public function template() {
        view('client.template', ['title' => 'Kho giao diện']);
    }
}