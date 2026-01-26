<?php
session_start();
require_once '../config.php'; // Đảm bảo đường dẫn này đúng với cấu trúc thư mục của bạn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Lấy thông tin user từ database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $account = $stmt->fetch();

    // KIỂM TRA MẬT KHẨU (DẠNG KHÔNG MÃ HÓA)
    // So sánh trực tiếp mật khẩu nhập vào với mật khẩu trong database
    if ($account && $pass == $account['password']) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index");
        exit;
    } else {
        $error = "Sai thông tin đăng nhập!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h3 class="text-center mb-4">Quản Trị Viên</h3>
        <?php if (isset($error))
            echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Tài khoản</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
</body>

</html>