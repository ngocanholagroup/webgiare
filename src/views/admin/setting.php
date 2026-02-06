<?php include 'includes/admin-header.php'; ?>

<?php
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

    // === PHẦN 2: LIÊN HỆ (Dùng thủ thuật tạo khoảng trống để tách biệt) ===
    [
        'label' => '--- THÔNG TIN LIÊN HỆ ---',
        'name'  => 'divider_1',
        'type'  => 'text',
        'disabled' => true, // Hack để làm tiêu đề ngăn cách
        'width' => 'col-span-12 bg-slate-100 font-bold text-center border-none' 
    ],
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
        'name'  => 'social_facebook',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
    ],
    [
        'label' => 'Link Zalo OA / Cá nhân',
        'name'  => 'social_zalo',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
    ],

    // === PHẦN 4: CẤU HÌNH SEO MẶC ĐỊNH ===
    [
        'label' => '--- CẤU HÌNH SEO MẶC ĐỊNH ---',
        'name'  => 'divider_2',
        'type'  => 'text',
        'disabled' => true,
        'width' => 'col-span-12 bg-slate-100 font-bold text-center border-none'
    ],
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

<?php include 'includes/admin-footer.php'; ?>