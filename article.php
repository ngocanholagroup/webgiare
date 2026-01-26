<?php
require_once 'config.php';

$slug = $_GET['slug'] ?? '';
$stmt = $conn->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    die("Bài viết không tồn tại!"); // Hoặc redirect về 404
}

// Tăng view
$conn->query("UPDATE posts SET views = views + 1 WHERE id = " . $post['id']);

// Lấy danh sách bài viết khác (Sidebar)
$stmt_related = $conn->prepare("SELECT * FROM posts WHERE id != ? ORDER BY created_at DESC LIMIT 5");
$stmt_related->execute([$post['id']]);
$related_posts = $stmt_related->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?> - HolaGroup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Tùy chỉnh thanh cuộn trang */
        body {
            background-color: #f8f9fa;
        }

        /* --- BREADCRUMB --- */
        .breadcrumb-wrapper {
            background: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .breadcrumb {
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            color: #0d6efd;
        }

        .breadcrumb-item.active {
            color: #333;
            font-weight: 600;
        }

        /* --- ARTICLE CARD --- */
        .article-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        /* Responsive padding cho mobile */
        @media (max-width: 768px) {
            .article-card {
                padding: 20px;
            }
        }

        .article-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .article-meta i {
            margin-right: 5px;
            color: #0d6efd;
        }

        /* Style cho nội dung bài viết từ CKEditor */
        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2c3e50;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 25px 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .article-content h2 {
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.75rem;
            color: #1a1a1a;
        }

        .article-content h3 {
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-size: 1.4rem;
            color: #333;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .article-content blockquote {
            border-left: 4px solid #0d6efd;
            padding-left: 20px;
            font-style: italic;
            color: #555;
            background: #f8faff;
            padding: 15px;
            border-radius: 0 8px 8px 0;
        }

        /* --- SIDEBAR --- */
        .sidebar-widget {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .widget-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            padding-left: 15px;
        }

        .widget-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 4px;
            background: linear-gradient(to bottom, #0d6efd, #0dcaf0);
            border-radius: 2px;
        }

        .related-post-item {
            display: flex;
            gap: 15px;
            padding: 12px;
            border-radius: 8px;
            transition: background 0.2s;
            text-decoration: none;
            /* Bỏ gạch chân */
        }

        .related-post-item:hover {
            background: #f8f9fa;
        }

        .related-thumb {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .related-content {
            flex: 1;
        }

        .related-title {
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #333;
            transition: color 0.2s;
        }

        .related-post-item:hover .related-title {
            color: #0d6efd;
        }

        /* Social Share Buttons */
        .btn-share {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: transform 0.2s;
            text-decoration: none;
            color: white !important;
        }

        .btn-share:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .btn-facebook {
            background-color: #1877f2;
        }

        .btn-twitter {
            background-color: #1da1f2;
        }

        .btn-zalo {
            background-color: #0068ff;
        }

        .btn-copy {
            background-color: #6c757d;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <!-- Container chính -->
    <div class="container pb-5" style="margin-top: 100px;">

        <!-- Breadcrumb Gọn Gàng -->
        <div class="breadcrumb-wrapper reveal-on-scroll">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door-fill"></i> Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="blog.php">Tin tức</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($post['title']) ?></li>
                </ol>
            </nav>
        </div>

        <div class="row g-4">
            <!-- CỘT TRÁI: NỘI DUNG BÀI VIẾT (8 phần) -->
            <div class="col-lg-8">
                <div class="article-card">
                    <!-- Tiêu đề bài viết -->
                    <h1 class="fw-bold mb-3 lh-base"><?= htmlspecialchars($post['title']) ?></h1>

                    <!-- Meta info -->
                    <div class="article-meta d-flex flex-wrap gap-4 mb-4 pb-3 border-bottom">
                        <span><i class="bi bi-person-circle"></i> Admin</span>
                        <span><i class="bi bi-calendar3"></i>
                            <?= date('d/m/Y', strtotime($post['created_at'])) ?></span>
                        <span><i class="bi bi-eye-fill"></i> <?= $post['views'] ?> lượt xem</span>
                    </div>

                    <!-- Ảnh đại diện bài viết -->
                    <?php if ($post['thumbnail']): ?>
                        <div class="mb-4 text-center">
                            <img src="<?= $post['thumbnail'] ?>" class="w-100 rounded shadow-sm"
                                style="max-height: 500px; object-fit: cover;" alt="<?= htmlspecialchars($post['title']) ?>">
                        </div>
                    <?php endif; ?>

                    <!-- Nội dung chính -->
                    <div class="article-content">
                        <?= $post['content'] ?>
                    </div>

                    <!-- Khu vực chia sẻ (Đã sửa lỗi) -->
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="fw-bold mb-3"><i class="bi bi-share-fill me-2"></i>Chia sẻ bài viết:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://www.facebook.com/share/16tQUeGZYg/" target="_blank"
                                class="btn-share btn-facebook">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI: SIDEBAR (4 phần) -->
            <div class="col-lg-4">
                <div class="sticky-lg-top" style="top: 100px; z-index: 1;">
                    <!-- Widget: Bài viết mới nhất -->
                    <div class="sidebar-widget">
                        <h5 class="widget-title">Bài viết mới nhất</h5>

                        <?php if (count($related_posts) > 0): ?>
                            <div class="d-flex flex-column gap-1">
                                <?php foreach ($related_posts as $rp): ?>
                                    <a href="article.php?slug=<?= $rp['slug'] ?>" class="related-post-item">
                                        <img src="<?= $rp['thumbnail'] ? $rp['thumbnail'] : 'assets/img/default-blog.jpg' ?>"
                                            class="related-thumb" alt="Thumbnail">
                                        <div class="related-content">
                                            <span class="related-title">
                                                <?= htmlspecialchars($rp['title']) ?>
                                            </span>
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                <i
                                                    class="bi bi-calendar2-event me-1"></i><?= date('d/m/Y', strtotime($rp['created_at'])) ?>
                                            </small>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted small">Chưa có bài viết khác.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Widget: Quảng cáo / CTA -->
                    <div class="sidebar-widget bg-primary text-white text-center p-4"
                        style="background: linear-gradient(135deg, #0d6efd, #0a58ca) !important;">
                        <div class="mb-3">
                            <i class="bi bi-rocket-takeoff-fill fs-1"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Cần Website Mới?</h5>
                        <p class="small mb-3 text-white-50">Đăng ký ngay để nhận ưu đãi thiết kế website trọn gói giá
                            rẻ, chuẩn SEO.</p>
                        <a href="index.php#contact" class="btn btn-light btn-sm w-100 fw-bold text-primary shadow-sm">
                            Nhận tư vấn ngay
                        </a>
                    </div>

                    <!-- Widget: Tags -->
                    <div class="sidebar-widget">
                        <h5 class="widget-title">Chủ đề quan tâm</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#"
                                class="badge bg-light text-dark text-decoration-none border px-3 py-2 fw-normal">Thiết
                                kế web</a>
                            <a href="#"
                                class="badge bg-light text-dark text-decoration-none border px-3 py-2 fw-normal">SEO</a>
                            <a href="#"
                                class="badge bg-light text-dark text-decoration-none border px-3 py-2 fw-normal">Marketing</a>
                            <a href="#"
                                class="badge bg-light text-dark text-decoration-none border px-3 py-2 fw-normal">Hosting</a>
                            <a href="#"
                                class="badge bg-light text-dark text-decoration-none border px-3 py-2 fw-normal">Công
                                nghệ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>