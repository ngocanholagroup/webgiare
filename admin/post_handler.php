<?php
session_start();
require_once '../config.php';

// Kiểm tra quyền đăng nhập
if (!isset($_SESSION['admin_logged_in'])) {
    die("Access Denied");
}

$action = $_REQUEST['action'] ?? '';

// Hàm xử lý upload ảnh tối ưu hơn
function uploadThumbnail($file)
{
    if ($file['error'] == 0) {
        // 1. Xác định đường dẫn thư mục uploads (nằm ngoài thư mục admin)
        // __DIR__ là thư mục admin, đi ra ngoài 1 cấp (..) để tới root, rồi vào uploads
        $targetDir = __DIR__ . '/../assets/uploads/';

        // 2. Nếu thư mục chưa có thì tạo mới
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // 3. Tạo tên file mới ngẫu nhiên để tránh trùng
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $ext;
        $targetFile = $targetDir . $fileName;

        // 4. Di chuyển file
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // Trả về đường dẫn tương đối để lưu vào database
            // Lưu ý: Đường dẫn này dùng để hiển thị thẻ <img src="...">
            return 'assets/uploads/' . $fileName;
        }
    }
    return null;
}

try {
    if ($action == 'create') {
        $title = $_POST['title'];
        // Tạo slug và thêm timestamp để đảm bảo unique
        $slug = createSlug($title) . '-' . time();
        $summary = $_POST['summary'];
        $content = $_POST['content'];

        // Xử lý ảnh
        $thumbnail = null;
        if (isset($_FILES['thumbnail'])) {
            $thumbnail = uploadThumbnail($_FILES['thumbnail']);
        }

        $sql = "INSERT INTO posts (title, slug, summary, content, thumbnail) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $slug, $summary, $content, $thumbnail]);

    } elseif ($action == 'update') {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];

        // Logic update: Nếu có ảnh mới thì update cả ảnh, không thì giữ nguyên
        if (!empty($_FILES['thumbnail']['name'])) {
            $thumbnail = uploadThumbnail($_FILES['thumbnail']);
            $sql = "UPDATE posts SET title=?, summary=?, content=?, thumbnail=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $summary, $content, $thumbnail, $id]);
        } else {
            $sql = "UPDATE posts SET title=?, summary=?, content=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $summary, $content, $id]);
        }

    } elseif ($action == 'delete') {
        $id = $_GET['id'];

        // (Tùy chọn) Lấy thông tin bài viết để xóa ảnh cũ nếu cần
        // $stmt = $conn->prepare("SELECT thumbnail FROM posts WHERE id = ?"); ...

        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
    }
} catch (Exception $e) {
    // Ghi log lỗi hoặc hiển thị thông báo
    die("Lỗi: " . $e->getMessage());
}

// Chuyển hướng về trang danh sách
header("Location: index");
exit;
?>