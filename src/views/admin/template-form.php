<?php include 'includes/admin-header.php'; ?>

<?php
// 1. CHUẨN BỊ DỮ LIỆU
$isEdit = isset($template);
$data = $template ?? [];

// [QUAN TRỌNG] Chuẩn bị dữ liệu Gallery để hiển thị trong Form
// Form.php yêu cầu mảng các URL ảnh để hiển thị preview ảnh cũ
$galleryUrls = [];
if (!empty($gallery)) {
    foreach ($gallery as $img) {
        $galleryUrls[] = $img['image_url'];
    }
}
$data['gallery_files'] = $galleryUrls; // Gán vào data để form tự nhận

// Chuẩn bị danh mục
$categoryOptions = [];
if (!empty($categories)) {
    foreach ($categories as $cat) {
        $categoryOptions[$cat['id']] = $cat['name'];
    }
}

// 2. CẤU HÌNH FIELDS
$form_fields = [
    // --- Hàng 1: Cơ bản ---
    [
        'label' => 'Tên giao diện',
        'name'  => 'name',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-8',
        'placeholder' => 'VD: Bất động sản cao cấp...'
    ],
    [
        'label' => 'Mã SKU',
        'name'  => 'sku',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-4',
        'placeholder' => 'VD: THEME-001'
    ],

    // --- Hàng 2: Ảnh chính (Bắt buộc) ---
    [
        'label' => 'Ảnh Desktop (Ảnh chính)',
        'name'  => 'image_desktop',
        'type'  => 'file',      
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Kích thước chuẩn: 1200x800px (3:2).'
    ],
    [
        'label' => 'Ảnh Mobile',
        'name'  => 'image_mobile',
        'type'  => 'file',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Kích thước chuẩn: 400x800px (1:2)'
    ],

    // --- Hàng 3: GALLERY (Upload nhiều ảnh) ---
    [
        'label'    => 'Thư viện ảnh phụ (Gallery)',
        'name'     => 'gallery_files',  // Tên field
        'type'     => 'file',
        'multiple' => true,             // [QUAN TRỌNG] Cho phép chọn nhiều file
        'width'    => 'col-span-12',
        'note'     => 'Giữ phím Ctrl để chọn nhiều ảnh. Ảnh cũ sẽ hiển thị bên dưới.'
    ],

    // --- Hàng 4: Danh mục & Slug ---
    [
        'label' => 'Danh mục',
        'name'  => 'category_id',
        'type'  => 'select',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'options' => $categoryOptions
    ],
    [
        'label' => 'Slug (Đường dẫn)',
        'name'  => 'slug',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'tu-dong-tao-neu-de-trong'
    ],

    // --- Hàng 5: Giá cả ---
    [
        'label' => 'Giá gốc',
        'name'  => 'price',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => '0'
    ],
    [
        'label' => 'Giá khuyến mãi',
        'name'  => 'sale_price',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => '0'
    ],

    // --- Hàng 6: Khác ---
    [
        'label' => 'Link Demo',
        'name'  => 'demo_url',
        'type'  => 'text',
        'width' => 'col-span-12',
        'placeholder' => 'https://demo...'
    ],
    [
        'label' => 'Điểm Desktop',
        'name'  => 'score_desktop',
        'type'  => 'text',
        'width' => 'col-span-4',
        'placeholder' => '100'
    ],
    [
        'label' => 'Điểm Mobile',
        'name'  => 'score_mobile',
        'type'  => 'text',
        'width' => 'col-span-4',
        'placeholder' => '95'
    ],
    [
        'label' => 'Trạng thái',
        'name'  => 'status',
        'type'  => 'select',
        'width' => 'col-span-4',
        'options' => ['1' => 'Hiện', '0' => 'Ẩn']
    ],
    [
        'label' => 'Mô tả',
        'name'  => 'description',
        'type'  => 'textarea',
        'width' => 'col-span-12',
        'rows'  => 5
    ]
];

// 3. CẤU HÌNH CHUNG
$form_title = $isEdit ? 'Cập nhật giao diện: ' . $template['name'] : 'Thêm giao diện mới';
$form_action = $isEdit ? '/admin/template/update/' . $template['id'] : '/admin/template/store';
$form_back_link = '/admin/template';
$form_data = $data;

// 4. HIỂN THỊ FORM
include 'includes/form.php';
?>

<?php include 'includes/admin-footer.php'; ?>