<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once '../config.php';

// --- XỬ LÝ ĐỔI TRẠNG THÁI (UPDATE STATUS) ---
if (isset($_POST['toggle_status_id'])) {
    $id = $_POST['toggle_status_id'];
    $current_status = $_POST['current_status'];
    // Nếu đang là 0 (New) thì đổi thành 1 (Done) và ngược lại
    $new_status = ($current_status == 0) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE contact_requests SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);

    // Refresh trang để cập nhật lại bảng, giữ nguyên query params
    header("Location: requests.php?" . $_SERVER['QUERY_STRING']);
    exit;
}

// --- XỬ LÝ LỌC (FILTER) ---
$where_clauses = [];
$params = [];

// 1. Lọc theo trạng thái
$status_filter = $_GET['status'] ?? 'all';
if ($status_filter !== 'all') {
    $where_clauses[] = "status = ?";
    $params[] = $status_filter;
}

// 2. Lọc theo ngày
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

if (!empty($start_date)) {
    $where_clauses[] = "DATE(created_at) >= ?";
    $params[] = $start_date;
}
if (!empty($end_date)) {
    $where_clauses[] = "DATE(created_at) <= ?";
    $params[] = $end_date;
}

// Tạo câu SQL hoàn chỉnh
$sql = "SELECT * FROM contact_requests";
if (count($where_clauses) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}
$sql .= " ORDER BY created_at DESC";

// Thực thi truy vấn
$stmt = $conn->prepare($sql);
$stmt->execute($params);
$requests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Yêu cầu Khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        .status-badge {
            width: 100px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar Admin -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Admin Panel</a>
            <div>
                <a href="../" class="btn btn-outline-light btn-sm me-2 fw-bold">Về trang chủ</a>
                <a href="index.php" class="btn btn-outline-light btn-sm me-2">Bài viết</a>
                <a href="requests.php" class="btn btn-light btn-sm me-2 fw-bold">Yêu cầu KH</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container bg-white p-4 rounded shadow-sm">
        <h3 class="mb-4">Danh sách Khách hàng liên hệ</h3>

        <!-- BỘ LỌC (FILTER) -->
        <form method="GET" class="row g-3 mb-4 p-3 bg-light rounded border">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Trạng thái</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="all" <?= $status_filter == 'all' ? 'selected' : '' ?>>Tất cả</option>
                    <option value="0" <?= $status_filter == '0' ? 'selected' : '' ?>>Chưa xử lý</option>
                    <option value="1" <?= $status_filter == '1' ? 'selected' : '' ?>>Đã xử lý</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Từ ngày</label>
                <input type="date" name="start_date" class="form-control form-control-sm" value="<?= $start_date ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Đến ngày</label>
                <input type="date" name="end_date" class="form-control form-control-sm" value="<?= $end_date ?>">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-sm w-100 me-2"><i class="bi bi-funnel"></i>
                    Lọc</button>
                <a href="requests.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-counterclockwise"></i>
                    Reset</a>
            </div>
        </form>

        <!-- BẢNG DỮ LIỆU -->
        <div class="table-responsive">
            <table class="table table-hover align-middle border">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th width="30%">Nội dung</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($requests) > 0): ?>
                        <?php foreach ($requests as $req): ?>
                            <tr class="<?= $req['status'] == 0 ? 'table-warning' : '' ?>"> <!-- Highlight dòng chưa xử lý -->
                                <td>
                                    <?= $req['id'] ?>
                                </td>
                                <td class="fw-bold">
                                    <?= htmlspecialchars($req['full_name']) ?>
                                </td>
                                <td>
                                    <a href="tel:<?= htmlspecialchars($req['phone']) ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($req['phone']) ?>
                                    </a>
                                </td>
                                <td>
                                    <?= nl2br(htmlspecialchars($req['message'])) ?>
                                </td>
                                <td>
                                    <?= date('H:i d/m/Y', strtotime($req['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($req['status'] == 0): ?>
                                        <span class="badge bg-warning text-dark status-badge">Chưa xử lý</span>
                                    <?php else: ?>
                                        <span class="badge bg-success status-badge">Đã xong</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Form cập nhật trạng thái -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="toggle_status_id" value="<?= $req['id'] ?>">
                                        <input type="hidden" name="current_status" value="<?= $req['status'] ?>">
                                        <?php if ($req['status'] == 0): ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Đánh dấu đã xong">
                                                <i class="bi bi-check-lg"></i> Xử lý
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-sm btn-outline-secondary"
                                                title="Đánh dấu chưa xong">
                                                <i class="bi bi-arrow-counterclockwise"></i> Hoàn tác
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Không tìm thấy yêu cầu nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>