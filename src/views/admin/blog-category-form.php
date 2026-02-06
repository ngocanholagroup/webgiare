<?php include 'includes/admin-header.php'; ?>

<?php
// 1. CHUẨN BỊ DỮ LIỆU
$isEdit = isset($category);
$data = $category ?? [];

// 2. CẤU HÌNH FIELDS
// (Database blog_categories chỉ có name và slug, không có description)
$form_fields = [
    [
        'label' => 'Tên danh mục',
        'name'  => 'name',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'VD: Thủ thuật, Tin tức, Sự kiện...'
    ],
    [
        'label' => 'Slug (Đường dẫn)',
        'name'  => 'slug',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'tu-dong-tao-tu-ten-danh-muc',
        'note' => 'Để trống sẽ tự động tạo từ tên danh mục.'
    ]
];

// 3. CẤU HÌNH CHUNG
$form_title = $isEdit ? 'Cập nhật danh mục: ' . $category['name'] : 'Thêm danh mục bài viết';
$form_action = $isEdit ? '/admin/blog-category/update/' . $category['id'] : '/admin/blog-category/store';

// Quay lại tab categories của trang Blog
$form_back_link = '/admin/blog?tab=categories'; 
$form_data = $data;

// 4. HIỂN THỊ FORM
include 'includes/form.php';
?>

<?php include 'includes/admin-footer.php'; ?>