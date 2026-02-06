<?php
class ContactController {
    
    public function index() {
        $model = new Contact();
        $services = $model->getServices();
        view('client.contact', [
            'title' => 'Liên hệ tư vấn',
            'services' => $services
        ]);
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 1. Sanitize (Làm sạch dữ liệu)
            $name    = trim(strip_tags($_POST['full_name'] ?? ''));
            $phone   = trim(strip_tags($_POST['phone'] ?? ''));
            $email   = trim(strip_tags($_POST['email'] ?? ''));
            $service = trim(strip_tags($_POST['service_type'] ?? ''));
            $msg     = trim(strip_tags($_POST['message'] ?? ''));
            $tpl     = trim(strip_tags($_POST['template_sku'] ?? ''));

            // 2. Validate (Kiểm tra dữ liệu)
            $errors = [];

            if (empty($name) || mb_strlen($name) < 2) {
                $errors[] = "Họ tên không hợp lệ.";
            }

            // Regex check số điện thoại VN (đơn giản)
            if (!preg_match('/^(0[3|5|7|8|9])+([0-9]{8})$/', $phone)) {
                $errors[] = "Số điện thoại không đúng định dạng.";
            }

            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email không hợp lệ.";
            }

            if (empty($service)) {
                $errors[] = "Vui lòng chọn dịch vụ.";
            }

            if (empty($msg) || mb_strlen($msg) < 10) {
                $errors[] = "Nội dung lời nhắn quá ngắn.";
            }

            // 3. Xử lý kết quả
            if (!empty($errors)) {
                // Có lỗi -> Alert lỗi đầu tiên và quay lại
                $errorString = implode("\\n", $errors);
                echo "<script>alert('$errorString'); history.back();</script>";
                return;
            }

            // 4. Lưu vào DB
            $model = new Contact();
            $data = [
                'full_name' => $name,
                'phone' => $phone,
                'email' => $email,
                'service_type' => $service,
                'template_sku' => $tpl,
                'message' => $msg
            ];
            
            $model->create($data);

            echo "<script>alert('Gửi yêu cầu thành công! Chúng tôi sẽ liên hệ lại sớm.'); window.location='/lien-he';</script>";
        }
    }
}