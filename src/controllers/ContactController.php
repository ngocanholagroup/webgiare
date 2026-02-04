<?php
// src/controllers/ContactController.php
require_once __DIR__ . '/../models/Contact.php';

class ContactController {
    private $contactModel;

    public function __construct() {
        $this->contactModel = new ContactModel();
    }

    // 1. Hiển thị trang liên hệ
    public function index() {
        $title = 'Liên hệ - HolaGroup';
        
        // Lấy template từ URL nếu có (VD: /lien-he?template=THEME-001)
        $selected_template = $_GET['template'] ?? '';
        
        view('client.contact', [
            'title' => $title,
            'selected_template' => $selected_template
        ]);
    }

    // 2. Xử lý Form Submit
    public function submit() {
        // Kiểm tra method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /lien-he');
            exit;
        }

        // Lấy dữ liệu
        $full_name = trim($_POST['full_name'] ?? '');
        $phone     = trim($_POST['phone'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $service   = $_POST['service_type'] ?? '';
        $message   = trim($_POST['message'] ?? '');
        $template  = $_POST['template_sku'] ?? null; // Input ẩn hoặc lấy từ URL

        // Validate cơ bản
        $errors = [];
        if (empty($full_name)) $errors[] = "Vui lòng nhập họ tên.";
        if (empty($phone)) $errors[] = "Vui lòng nhập số điện thoại.";

        if (!empty($errors)) {
            // Lưu lỗi vào session hoặc truyền lại view (Ở đây làm đơn giản là alert)
            echo "<script>alert('" . implode("\\n", $errors) . "'); window.history.back();</script>";
            return;
        }

        // Lưu vào DB
        $data = [
            'full_name' => $full_name,
            'phone' => $phone,
            'email' => $email,
            'service_type' => $service,
            'related_template' => $template,
            'message' => $message
        ];

        if ($this->contactModel->create($data)) {
            echo "<script>alert('Gửi yêu cầu thành công! Chúng tôi sẽ liên hệ lại trong 15 phút.'); window.location.href='/lien-he';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại.'); window.history.back();</script>";
        }
    }
}