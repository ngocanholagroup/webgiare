<?php
require_once 'config.php';

// --- PHẦN 1: XỬ LÝ FORM LIÊN HỆ ---
$contact_alert = ""; // Biến chứa thông báo

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_send_contact'])) {
  $fullName = trim($_POST['full_name']);
  $phone = trim($_POST['phone']);
  $message = trim($_POST['message']);

  if (!empty($fullName) && !empty($phone)) {
    try {
      $stmt = $conn->prepare("INSERT INTO contact_requests (full_name, phone, message) VALUES (?, ?, ?)");
      $stmt->execute([$fullName, $phone, $message]);

      // Thông báo thành công (dùng JS alert cho đơn giản hoặc HTML alert)
      $contact_alert = '<div class="alert alert-success small">Đã gửi yêu cầu thành công! Chúng tôi sẽ liên hệ sớm.</div>';
    } catch (Exception $e) {
      $contact_alert = '<div class="alert alert-danger small">Lỗi: ' . $e->getMessage() . '</div>';
    }
  } else {
    $contact_alert = '<div class="alert alert-warning small">Vui lòng điền tên và số điện thoại.</div>';
  }
}

// --- PHẦN 2: LẤY BÀI VIẾT MỚI (Code cũ của bạn) ---
try {
  $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 3");
  $latest_posts = $stmt->fetchAll();
} catch (Exception $e) {
  $latest_posts = [];
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <title>Thiết Kế Website & Hosting - WebPro Hub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <!-- NAVBAR PHP INCLUDE -->
  <?php include __DIR__ . '/partials/navbar.php'; ?>

  <!-- HERO -->
  <section id="hero" class="hero-section-advanced position-relative overflow-hidden">
    <!-- SHAPES BACKGROUND -->
    <div class="hero-shape hero-shape-1"></div>
    <div class="hero-shape hero-shape-2"></div>
    <div class="hero-shape hero-shape-3"></div>

    <div class="container position-relative z-2">
      <div class="row align-items-center g-4">
        <!-- LEFT CONTENT -->
        <div class="col-lg-7 reveal-on-scroll">
          <div class="hero-badge-advanced mb-3">
            🚀 Giải pháp Website & Hosting trọn gói
          </div>

          <h1 class="hero-title-advanced mb-3">
            Thiết kế Website chuyên nghiệp<br />
            <span class="gradient-text">Uy tín – Nhanh chóng</span>
          </h1>

          <p class="hero-desc mb-4">
            Chúng tôi là đơn vị chuyên cung cấp dịch vụ thiết kế website chuẩn
            SEO, tốc độ cao và dễ quản trị.
          </p>

          <div class="d-flex flex-wrap gap-3 mb-4">
            <a href="#contact" class="btn btn-hero-primary">
              <i class="bi bi-rocket-takeoff me-1"></i> Nhận tư vấn ngay
            </a>
            <a href="#pricing" class="btn btn-hero-outline">
              <i class="bi bi-eye me-1"></i> Xem bảng giá
            </a>
          </div>
          <!-- TRUST BADGES -->
          <div class="hero-trust mt-4">
            <div class="trust-item"><i class="bi bi-lightning-charge-fill"></i> Tốc độ cao</div>
            <div class="trust-item"><i class="bi bi-shield-check"></i> Bảo mật mạnh</div>
            <div class="trust-item"><i class="bi bi-graph-up-arrow"></i> Chuẩn SEO</div>
          </div>
        </div>

        <!-- RIGHT VISUAL -->
        <div class="col-lg-5 reveal-on-scroll">
          <div class="hero-visual-wrapper">
            <div class="hero-browser">
              <div class="hero-browser-header">
                <div class="dots"><span></span><span></span><span></span></div>
                <div class="hero-url-bar">HolaGroup</div>
              </div>
              <div class="hero-browser-body">
                <div class="hero-sidebar">
                  <div class="hero-menu-item active"><i class="bi bi-grid-1x2-fill"></i></div>
                  <div class="hero-menu-item"><i class="bi bi-cart3"></i></div>
                </div>
                <div class="hero-main-screen">
                  <div class="hero-main-banner"></div>
                  <div class="hero-main-cards">
                    <div class="hero-main-card"></div>
                    <div class="hero-main-card"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="stats-section stats-bar reveal-on-scroll">
    <div class="container">
      <div class="stats-heading text-center mb-3">
        <h2 class="stats-title">DỊCH VỤ THIẾT KẾ WEBSITE GIÁ RẺ</h2>
      </div>
      <div class="row text-center g-3 stats-row">
        <div class="col-6 col-lg-3">
          <div class="stat-item" data-scroll-target="#pricing">
            <div class="stat-icon"><i class="bi bi-award-fill"></i></div>
            <div class="stat-number counter" data-target="10">0</div>
            <div class="stat-label">năm kinh nghiệm</div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="stat-item" data-scroll-target="#contact">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-number counter" data-target="1732">0</div>
            <div class="stat-label">khách hàng</div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="stat-item" data-scroll-target="#portfolio">
            <div class="stat-icon"><i class="bi bi-kanban-fill"></i></div>
            <div class="stat-number counter" data-target="1200">0</div>
            <div class="stat-label">dự án triển khai</div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="stat-item" data-scroll-target="#contact">
            <div class="stat-icon"><i class="bi bi-emoji-smile-fill"></i></div>
            <div class="stat-number counter" data-target="96">0</div>
            <div class="stat-label">khách hàng hài lòng</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BENEFITS -->
  <section id="benefits" class="section-padding benefits-section bg-light">
    <div class="container">
      <div class="text-center mb-4 reveal-on-scroll">
        <h2 class="section-title"><span class="gradient-text">LỢI ÍCH</span> CỦA VIỆC <span class="gradient-text">SỞ HỮU
            WEBSITE</span></h2>
      </div>
      <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-4">
          <div class="benefit-card reveal-on-scroll" style="background-image: url('assets/img/benefit-1.png')">
            <div class="benefit-overlay"></div>
            <div class="benefit-content">
              <h3 class="benefit-title">Giao diện đẹp, bố cục hiện đại</h3>
              <span class="benefit-arrow"><i class="bi bi-arrow-right"></i></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="benefit-card reveal-on-scroll" style="background-image: url('assets/img/benefit-2.png')">
            <div class="benefit-overlay"></div>
            <div class="benefit-content">
              <h3 class="benefit-title">Chuẩn SEO giúp dễ lên top Google</h3>
              <span class="benefit-arrow"><i class="bi bi-arrow-right"></i></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="benefit-card reveal-on-scroll" style="background-image: url('assets/img/benefit-3.png')">
            <div class="benefit-overlay"></div>
            <div class="benefit-content">
              <h3 class="benefit-title">Tốc độ tải trang nhanh</h3>
              <span class="benefit-arrow"><i class="bi bi-arrow-right"></i></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRICING -->
  <section id="pricing" class="section-padding pricing-section">
    <div class="container">
      <div class="text-center mb-4 reveal-on-scroll">
        <h2 class="section-title">BẢNG GIÁ <span class="gradient-text">THIẾT KẾ WEBSITE</span></h2>
        <p class="section-subtitle">Chi phí tối ưu - Hiệu quả tối đa</p>
      </div>
      <div class="row g-4 align-items-stretch">
        <!-- Gói 1 -->
        <div class="col-md-4 reveal-on-scroll">
          <div class="pricing-card pricing-card-basic h-100">
            <div class="pricing-old-price">3.000.000đ</div>
            <div class="pricing-inner">
              <h6 class="pricing-name text-white">Theo mẫu có sẵn</h6>
              <div class="pricing-price pricing-current-price">2.000.000đ</div>
              <ul class="pricing-list">
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Thiết kế theo kho
                    mẫu</span></li>
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Hỗ trợ trọn đời</span>
                </li>
              </ul>
              <button class="btn-pricing btn-pricing-light">Tư vấn ngay</button>
            </div>
          </div>
        </div>
        <!-- Gói 2 -->
        <div class="col-md-4 reveal-on-scroll">
          <div class="pricing-card pricing-card-pro h-100">
            <div class="pricing-old-price">6.500.000đ</div>
            <div class="pricing-badge-featured"><i class="bi bi-fire"></i> Phổ biến</div>
            <div class="pricing-inner">
              <h6 class="pricing-name">Theo mẫu yêu cầu</h6>
              <div class="pricing-price">4.500.000đ</div>
              <ul class="pricing-list">
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Thiết kế theo
                    brand</span></li>
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Tối ưu UX/UI</span></li>
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Miễn phí Hosting
                    1GB</span></li>
              </ul>
              <button class="btn-pricing btn-pricing-gradient">Tư vấn ngay</button>
            </div>
          </div>
        </div>
        <!-- Gói 3 -->
        <div class="col-md-4 reveal-on-scroll">
          <div class="pricing-card pricing-card-custom h-100">
            <div class="pricing-inner">
              <h6 class="pricing-name">Yêu cầu đặc biệt</h6>
              <div class="pricing-price pricing-price-contact">Liên hệ</div>
              <ul class="pricing-list">
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Tích hợp API, CRM,
                    ERP</span></li>
                <li><span class="pricing-list-icon"><i class="bi bi-check-lg"></i></span><span>Bảo mật cao cấp</span>
                </li>
              </ul>
              <button class="btn-pricing btn-pricing-outline">Tư vấn ngay</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- NEW BLOG SECTION (Giống style Bảng giá) -->
  <section id="news-home" class="section-padding bg-light">
    <div class="container">
      <!-- Tiêu đề giống Bảng giá -->
      <div class="text-center mb-5 reveal-on-scroll">
        <h2 class="section-title">TIN TỨC <span class="gradient-text">& SỰ KIỆN</span></h2>
        <p class="section-subtitle">Cập nhật kiến thức công nghệ và hoạt động của HolaGroup</p>
      </div>

      <div class="row g-4">
        <?php if (count($latest_posts) > 0): ?>
          <?php foreach ($latest_posts as $post): ?>
            <div class="col-md-4 reveal-on-scroll">
              <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s;">
                <!-- Ảnh đại diện -->
                <div style="height: 200px; overflow: hidden; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                  <img src="<?= $post['thumbnail'] ? $post['thumbnail'] : 'assets/img/default-blog.jpg' ?>"
                    class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($post['title']) ?>">
                </div>

                <div class="card-body d-flex flex-column p-4">
                  <div class="small text-muted mb-2">
                    <i class="bi bi-calendar3"></i> <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                  </div>
                  <h5 class="card-title fw-bold mb-3">
                    <a href="article.php?slug=<?= $post['slug'] ?>" class="text-decoration-none text-dark">
                      <?= htmlspecialchars($post['title']) ?>
                    </a>
                  </h5>
                  <p class="card-text text-secondary small flex-grow-1"
                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                    <?= htmlspecialchars($post['summary']) ?>
                  </p>
                  <!-- Nút Xem thêm style đơn giản, đồng bộ -->
                  <div class="mt-3">
                    <a href="article.php?slug=<?= $post['slug'] ?>"
                      class="btn btn-outline-primary btn-sm rounded-pill px-4">
                      Xem chi tiết <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12 text-center text-muted">
            <p>Hiện chưa có bài viết nào.</p>
          </div>
        <?php endif; ?>
      </div>

      <!-- Nút xem tất cả -->
      <div class="text-center mt-5">
        <a href="blog" class="btn btn-primary-custom px-5">Xem tất cả tin tức</a>
      </div>
    </div>
  </section>

  <!-- WHY CHOOSE -->
  <section id="why-choose" class="section-padding why-section">
    <div class="container">
      <div class="text-center mb-4 reveal-on-scroll">
        <h2 class="section-title">TẠI SAO NÊN CHỌN <br /><span class="gradient-text">DỊCH VỤ THIẾT KẾ WEBSITE</span>
        </h2>
      </div>
      <div class="why-slider-wrapper reveal-on-scroll">
        <button class="why-nav-btn why-prev" type="button"><i class="bi bi-chevron-left"></i></button>
        <button class="why-nav-btn why-next" type="button"><i class="bi bi-chevron-right"></i></button>
        <div class="why-slider" id="whySlider">
          <article class="why-card">
            <div class="why-icon"><i class="bi bi-layout-text-window-reverse"></i></div>
            <h3 class="why-title">Thiết kế theo yêu cầu</h3>
            <p class="why-text">Tùy biến linh hoạt với kho giao diện đa dạng.</p>
          </article>
          <article class="why-card">
            <div class="why-icon"><i class="bi bi-headset"></i></div>
            <h3 class="why-title">Hỗ trợ tận tâm</h3>
            <p class="why-text">Đội ngũ tư vấn chuyên nghiệp, luôn sẵn sàng đồng hành.</p>
          </article>
          <article class="why-card">
            <div class="why-icon"><i class="bi bi-stars"></i></div>
            <h3 class="why-title">Chất lượng vượt trội</h3>
            <p class="why-text">Website chuẩn UX/UI, tối ưu hiệu suất.</p>
          </article>
          <article class="why-card">
            <div class="why-icon"><i class="bi bi-box-seam"></i></div>
            <h3 class="why-title">Giải pháp trọn gói</h3>
            <p class="why-text">Hosting, tên miền, bảo mật – tất cả đồng bộ.</p>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT FORM -->
  <section id="contact" class="section-padding contact-section">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6 reveal-on-scroll">
          <h2 class="section-title mb-2">Liên hệ tư vấn & báo giá</h2>
          <ul class="list-unstyled contact-info-list small mb-3">
            <li>
              <div class="contact-info-icon"><i class="bi bi-telephone-fill"></i></div>
              <div>
                <div class="fw-semibold">Hotline / Zalo</div><a href="tel:0973157932">0973157932</a>
              </div>
            </li>
            <li>
              <div class="contact-info-icon"><i class="bi bi-envelope-fill"></i></div>
              <div>
                <div class="fw-semibold">Email</div><a>sale@holagroup.com.vn</a>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-6 reveal-on-scroll">
          <div class="contact-card">
            <!-- PHẦN THÔNG BÁO -->
            <?php if (!empty($contact_alert))
              echo $contact_alert; ?>

            <!-- FORM ĐÃ CẬP NHẬT NAME VÀ METHOD -->
            <form action="" method="POST">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small mb-1">Họ và tên *</label>
                  <input type="text" name="full_name" class="form-control form-control-sm" required
                    placeholder="Nguyễn Văn A" />
                </div>
                <div class="col-md-6">
                  <label class="form-label small mb-1">Số điện thoại *</label>
                  <input type="tel" name="phone" class="form-control form-control-sm" required
                    placeholder="09xxxxxxx" />
                </div>
                <div class="col-12">
                  <label class="form-label small mb-1">Nội dung</label>
                  <textarea name="message" class="form-control form-control-sm" rows="3"
                    placeholder="Tôi cần tư vấn..."></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" name="btn_send_contact" class="btn btn-primary-custom w-100">Gửi yêu
                    cầu</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER PHP INCLUDE -->
  <?php include __DIR__ . '/partials/footer.php'; ?>

  <!-- JS: Bootstrap + custom -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>