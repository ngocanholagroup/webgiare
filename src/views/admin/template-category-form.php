<?php include 'includes/admin-header.php'; ?>

<?php
// 1. CHUẨN BỊ DỮ LIỆU
$isEdit = isset($category); // Biến truyền từ Controller edit($id)
$data = $category ?? [];

// 2. CẤU HÌNH FIELDS
$form_fields = [
    [
        'label' => 'Tên danh mục',
        'name'  => 'name',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'VD: Bất động sản, Thương mại điện tử...'
    ],
    [
        'label' => 'Slug (Đường dẫn)',
        'name'  => 'slug',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'tu-dong-tao-tu-ten-danh-muc',
        'note' => 'Để trống sẽ tự động tạo.'
    ],
    [
        'label' => 'Mô tả',
        'name'  => 'description',
        'type'  => 'textarea',
        'rows'  => 4,
        'width' => 'col-span-12',
        'placeholder' => 'Mô tả ngắn về loại giao diện này...'
    ]
];

// 3. CẤU HÌNH CHUNG
$form_title = $isEdit ? 'Cập nhật danh mục: ' . $category['name'] : 'Thêm danh mục giao diện mới';

// Lưu ý Router: /admin/category/... trỏ vào AdminTemplateCategoryController
$form_action = $isEdit ? '/admin/category/update/' . $category['id'] : '/admin/category/store';

// Quay lại tab category của trang Template
$form_back_link = '/admin/template?tab=category'; 
$form_data = $data;

// 4. HIỂN THỊ FORM
include 'includes/form.php';
?>

<?php include 'includes/admin-footer.php'; ?>