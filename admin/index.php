<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login");
    exit;
} // Redirect về login (không .php)
require_once '../config.php';

$stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <!-- Navbar Admin -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index">Admin Panel</a>
            <div>
                <!-- Link dạng route tên -->
                <a href="index" class="btn btn-light btn-sm me-2 fw-bold">Bài viết</a>
                <a href="requests" class="btn btn-outline-light btn-sm me-2">Yêu cầu KH</a>
                <a href="logout" class="btn btn-danger btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Danh sách bài viết</h2>
            <a href="post_editor" class="btn btn-success"><i class="bi bi-plus-lg"></i> Thêm bài mới</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th style="width: 100px;">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th style="width: 150px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td>
                            <?php if ($p['thumbnail']): ?>
                                <img src="../<?= $p['thumbnail'] ?>" style="height: 50px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['title']) ?></td>
                        <td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                        <td>
                            <!-- Link sửa/xóa dạng route -->
                            <a href="post_editor?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil"></i></a>
                            <a href="post_handler?action=delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa bài này?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>