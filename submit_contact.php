<?php
// submit_contact.php
header('Content-Type: application/json');
require_once 'config.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu gửi lên (dạng JSON hoặc Form Data)
    $input = json_decode(file_get_contents('php://input'), true);

    // Nếu không phải JSON raw, thử lấy $_POST thường
    if (!$input) {
        $input = $_POST;
    }

    $fullName = trim($input['full_name'] ?? '');
    $phone = trim($input['phone'] ?? '');
    $message = trim($input['message'] ?? '');

    if (!empty($fullName) && !empty($phone)) {
        try {
            // Mặc định status là 0 (Chưa xử lý)
            $stmt = $conn->prepare("INSERT INTO contact_requests (full_name, phone, message, status) VALUES (?, ?, ?, 0)");
            $stmt->execute([$fullName, $phone, $message]);

            $response['success'] = true;
            $response['message'] = 'Gửi yêu cầu thành công! Chúng tôi sẽ liên hệ sớm.';
        } catch (Exception $e) {
            $response['message'] = 'Lỗi hệ thống: ' . $e->getMessage();
        }
    } else {
        $response['message'] = 'Vui lòng điền đầy đủ Họ tên và Số điện thoại.';
    }
} else {
    $response['message'] = 'Invalid Request Method';
}

echo json_encode($response);
?>