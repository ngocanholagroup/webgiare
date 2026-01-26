<?php
require_once 'config';
// Lấy danh sách bài viết mới nhất
try {
    $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    $posts = [];
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tin tức & Kiến thức - HolaGroup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Tận dụng style Hero của trang chủ làm Header cho trang con */
        .page-header {
            background: linear-gradient(135deg, #ffd54a, #ff7a1a);
            /* Màu tối giống Hero */
            color: white;
            padding: 120px 0 60px 0;
            /* Padding top lớn để bù cho Navbar fixed */
            position: relative;
            overflow: hidden;
            margin-bottom: 3rem;
        }

        /* Hiệu ứng Shapes nền giống trang chủ */
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 60%);
            animation: rotate 30s linear infinite;
            z-index: 1;
        }

        .card-blog {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            height: 100%;
        }

        .card-blog:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .blog-thumb-wrapper {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .blog-thumb-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-blog:hover .blog-thumb-wrapper img {
            transform: scale(1.05);
        }

        .blog-summary {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-light"> <!-- Thêm nền xám nhạt cho body -->
    <?php include __DIR__ . '/partials/navbar'; ?>

    <!-- PAGE HEADER -->
    <header class="page-header text-center">
        <div class="container position-relative z-2">
            <h1 class="display-5 fw-bold mb-3">Tin Tức & Sự Kiện</h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 700px;">
                Cập nhật những xu hướng thiết kế website mới nhất, mẹo kinh doanh online và thông báo từ HolaGroup.
            </p>

        </div>
    </header>

    <!-- BLOG GRID -->
    <div class="container mb-5">
        <div class="row g-4">
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $p): ?>
                    <div class="col-md-4">
                        <article class="card card-blog shadow-sm">
                            <a href="article?slug=<?= $p['slug'] ?>" class="blog-thumb-wrapper">
                                <img src="<?= $p['thumbnail'] ? $p['thumbnail'] : 'assets/img/default-blog.jpg' ?>"
                                    alt="<?= htmlspecialchars($p['title']) ?>">
                            </a>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="small text-muted mb-2">
                                    <i class="bi bi-calendar3 me-1"></i> <?= date('d/m/Y', strtotime($p['created_at'])) ?>
                                </div>
                                <h4 class="card-title h5 fw-bold mb-3">
                                    <a href="article?slug=<?= $p['slug'] ?>"
                                        class="text-decoration-none text-dark stretched-link">
                                        <?= htmlspecialchars($p['title']) ?>
                                    </a>
                                </h4>
                                <p class="card-text blog-summary flex-grow-1"><?= htmlspecialchars($p['summary']) ?></p>
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-semibold small">Xem chi tiết</span>
                                    <i class="bi bi-arrow-right text-primary"></i>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <div class="py-5">
                        <i class="bi bi-inbox fs-1 text-muted"></i>
                        <p class="text-muted mt-3">Chưa có bài viết nào được đăng tải.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/partials/footer'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>