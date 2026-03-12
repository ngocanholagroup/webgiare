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
        'label' => 'Favicon (Icon trên tab)',
        'name'  => 'site_favicon_url',
        'type'  => 'file',
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Ảnh vuông nhỏ (ico, png).'
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
        'label' => 'Google Analytics ID (GA4)',
        'name' => 'google_analytics_id',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'G-XXXXXXXXXX',
        'note' => 'Nhập Measurement ID (G-XXXXXXXXXX). <a href="https://analytics.google.com/" target="_blank" class="text-blue-600 hover:underline font-medium">Truy cập Dashboard Google Analytics</a> để xem báo cáo chi tiết.'
    ],
    [
        'label' => 'Google Tag Manager ID (GTM)',
        'name' => 'google_tag_manager_id',
        'type' => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'GTM-XXXXXXX',
        'note' => 'Nhập Container ID nếu dùng GTM (Tùy chọn).'
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
    [
        'label' => 'Ảnh Share Facebook mặc định',
        'name'  => 'default_share_image',
        'type'  => 'file',
        'width' => 'col-span-12 md:col-span-6',
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