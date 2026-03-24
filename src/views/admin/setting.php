<?php include 'includes/admin-header.php'; ?>

<?php
// Debug: Hiển thị lỗi upload nếu có
if (isset($_SESSION['upload_error'])) {
    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">';
    echo '<strong>Lỗi upload:</strong> ' . htmlspecialchars($_SESSION['upload_error']);
    echo '</div>';
    unset($_SESSION['upload_error']); // Xóa sau khi hiển thị
}

// 1. CHUẨN BỊ DỮ LIỆU
// $settings từ controller trả về dạng ['company_name' => 'ABC', ...]
// Ta gán nó vào $form_data để form.php tự điền value
$form_data = $settings;

// 2. CẤU HÌNH FIELDS
$form_fields = [
    [
        'label' => '',
        'name' => 'dashboard_cta',
        'type' => 'custom',
        'width' => 'col-span-12',
        'html' => '
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Umami CTA -->
                <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-white rounded-full shadow-sm text-indigo-600">
                        <i data-lucide="bar-chart-3" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-indigo-900">Umami Analytics</h3>
                        <p class="text-indigo-600 text-sm mt-1">Xem thống kê truy cập và người dùng.</p>
                    </div>
                    <?php 
                        $umamiUrl = (strpos($_SERVER['HTTP_HOST'], 'webgiare.cloud') !== false) 
                                    ? 'https://umami.webgiare.cloud' 
                                    : 'http://localhost:3000';
                    ?>
                    <a href="<?= $umamiUrl ?>" target="_blank" class="w-full px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-sm flex items-center justify-center gap-2 transition-colors">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        Mở Dashboard
                    </a>
                </div>

                <!-- MinIO CTA -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-6 flex flex-col items-center text-center gap-4 hover:shadow-md transition-shadow">
                    <div class="p-3 bg-white rounded-full shadow-sm text-red-600">
                        <i data-lucide="database" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-red-900">MinIO Object Storage</h3>
                        <p class="text-red-600 text-sm mt-1">Quản lý file ảnh và bucket lưu trữ.</p>
                    </div>
                    <?php 
                        $minioUrl = (strpos($_SERVER['HTTP_HOST'], 'webgiare.cloud') !== false) 
                                    ? 'https://minio.webgiare.cloud' 
                                    : 'http://localhost:9001';
                    ?>
                    <a href="<?= $minioUrl ?>" target="_blank" class="w-full px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-sm flex items-center justify-center gap-2 transition-colors">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        Mở Console
                    </a>
                </div>
            </div>
        '
    ],
    // === PHẦN: KẾT NỐI ANALYTICS ===
    [
        'label' => 'Umami Website ID',
        'name'  => 'umami_website_id',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Lấy từ Umami Dashboard > Websites > Edit > Website ID.'
    ],
    [
        'label' => 'Umami Script URL',
        'name'  => 'umami_src_url',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'http://localhost:3000/script.js',
        'note'  => 'URL file script.js của Umami (VD: http://localhost:3000/script.js)'
    ],
    // === PHẦN 1: THÔNG TIN CHUNG ===
    [
        'label' => 'Tên công ty / Brandname',
        'name'  => 'company_name',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'VD: HolaGroup Tech'
    ],
    [
        'label' => 'Slogan',
        'name'  => 'company_slogan',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'VD: Giải pháp công nghệ toàn diện'
    ],
    [
        'label' => 'Logo Website',
        'name'  => 'site_logo_url',
        'type'  => 'file', // Tự động có preview ảnh cũ/mới
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Ảnh PNG nền trong suốt.'
    ],
    [
        'label' => 'Favicon',
        'name'  => 'site_favicon_url',
        'type'  => 'file',
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Icon nhỏ trên tab trình duyệt (16x16, 32x32).'
    ],
    [
        'label' => 'Ảnh Share mặc định',
        'name'  => 'default_share_image',
        'type'  => 'file',
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Ảnh hiển thị khi chia sẻ link lên Facebook/Zalo.'
    ],
    [
        'label' => 'Ảnh Share Facebook mặc định',
        'name'  => 'facebook_share_image',
        'type'  => 'file',
        'width' => 'col-span-12 md:col-span-6',
    ],

    // === PHẦN 2: LIÊN HỆ ===
    [
        'label' => 'Hotline / Số điện thoại',
        'name'  => 'company_phone',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => '09xxxx'
    ],
    [
        'label' => 'Email liên hệ',
        'name'  => 'company_email',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'contact@domain.com'
    ],
    [
        'label' => 'Địa chỉ văn phòng',
        'name'  => 'company_address',
        'type'  => 'text',
        'width' => 'col-span-12',
    ],
    [
        'label' => 'Mã nhúng bản đồ (Iframe)',
        'name'  => 'map_iframe',
        'type'  => 'textarea',
        'rows'  => 3,
        'width' => 'col-span-12',
        'note'  => 'Copy đoạn mã iframe từ Google Maps.'
    ],

    // === PHẦN 3: MẠNG XÃ HỘI ===
    [
        'label' => 'Link Facebook Fanpage',
        'name' => 'social_facebook',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'https://facebook.com/holagroup'
    ],
    [
        'label' => 'Link Twitter',
        'name' => 'social_twitter',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'https://twitter.com/holagroup'
    ],
    [
        'label' => 'Link TikTok',
        'name' => 'social_tiktok',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'https://tiktok.com/@holagroup'
    ],
    
    // === PHẦN 4: ANALYTICS & MARKETING ===
    [
        'label' => 'Umami Website ID',
        'name' => 'umami_website_id',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
        'note' => 'Lấy trong Umami -> Websites -> Edit -> Details.'
    ],
    [
        'label' => 'Umami Script URL',
        'name' => 'umami_src_url',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'http://localhost:3000/script.js',
        'note' => 'Mặc định: http://localhost:3000/script.js (Nếu dùng Docker) hoặc https://cloud.umami.is/script.js'
    ],
    [
        'label' => 'Link Google Business',
        'name' => 'social_google',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'https://google.com/holagroup'
    ],
    [
        'label' => 'Link Zalo',
        'name' => 'social_zalo',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'https://zalo.me/0973157932'
    ],

    // === PHẦN 4: CẤU HÌNH SEO MẶC ĐỊNH ===
    [
        'label' => 'Meta Title (Tiêu đề trang chủ)',
        'name'  => 'default_title',
        'type'  => 'text',
        'width' => 'col-span-12',
        'placeholder' => 'Tên web - Slogan...'
    ],
    [
        'label' => 'Meta Description (Mô tả)',
        'name'  => 'default_desc',
        'type'  => 'textarea',
        'rows'  => 2,
        'width' => 'col-span-12',
    ],
    [
        'label' => 'Meta Keywords',
        'name'  => 'default_keywords',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Cách nhau bằng dấu phẩy.'
    ],    
    // === PHẦN 5: CTA FOOTER ===
    [
        'label' => 'Tiêu đề CTA (Footer)',
        'name'  => 'cta_title',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
    ],
    [
        'label' => 'Mô tả CTA',
        'name'  => 'cta_desc',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
    ]
];

// 3. CẤU HÌNH FORM
$form_title = 'Cài đặt hệ thống toàn diện';
$form_action = '/admin/setting/save';
$form_submit_label = 'Lưu cấu hình';

// Không cần nút quay lại
$form_back_link = null; 

// 4. GỌI COMPONENT
include 'includes/form.php';
?>

<!-- Fixed Save Button -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 shadow-lg z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">
                <span id="save-status" class="hidden">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Đang lưu...
                </span>
                <span id="save-success" class="hidden text-green-600">
                    <i class="fas fa-check mr-2"></i>Đã lưu!
                </span>
            </div>
            <div class="flex gap-3">
                <button type="submit" form="main-form" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                    <i class="fas fa-save mr-2"></i>Lưu cấu hình
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add padding bottom to avoid content being hidden by fixed button -->
<style>
body {
    padding-bottom: 80px;
}
</style>

<!-- JavaScript for form handling -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('main-form');
    const saveStatus = document.getElementById('save-status');
    const saveSuccess = document.getElementById('save-success');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            // Show saving status
            saveStatus.classList.remove('hidden');
            saveSuccess.classList.add('hidden');
            
            // Hide saving status after 3 seconds (in case of slow response)
            setTimeout(() => {
                saveStatus.classList.add('hidden');
            }, 3000);
        });
    }
    
    // Show success message when page loads with success parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        saveSuccess.classList.remove('hidden');
        setTimeout(() => {
            saveSuccess.classList.add('hidden');
        }, 3000);
    }
});
</script>

<?php include 'includes/admin-footer.php'; ?>