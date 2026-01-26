<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once '../config.php';

$post = ['id' => '', 'title' => '', 'summary' => '', 'content' => '', 'thumbnail' => ''];
$isEdit = false;

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
    $isEdit = true;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>
        <?= $isEdit ? 'Sửa bài' : 'Thêm bài mới' ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
</head>

<body class="bg-light pb-5">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0">
                    <?= $isEdit ? 'Cập nhật bài viết' : 'Đăng bài viết mới' ?>
                </h4>
            </div>
            <div class="card-body">
                <form action="post_handler.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <input type="hidden" name="action" value="<?= $isEdit ? 'update' : 'create' ?>">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tiêu đề bài viết</label>
                                <input type="text" name="title" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($post['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nội dung chi tiết</label>
                                <textarea name="content" id="editor"><?= $post['content'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Mô tả ngắn (Summary)</label>
                                <textarea name="summary" class="form-control"
                                    rows="5"><?= htmlspecialchars($post['summary']) ?></textarea>
                                <div class="form-text">Hiển thị ở trang danh sách tin tức.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ảnh đại diện</label>
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                <?php if ($post['thumbnail']): ?>
                                    <div class="mt-2">
                                        <img src="../<?= $post['thumbnail'] ?>" class="img-thumbnail"
                                            style="max-height: 150px">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <hr>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Lưu bài viết</button>
                                <a href="index" class="btn btn-secondary">Hủy bỏ</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => { console.error(error); });
    </script>
</body>

</html>