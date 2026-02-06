<?php include 'includes/admin-header.php'; ?>

<?php
$isEdit = isset($post);
$data = $post ?? [];

// Convert options
$catOpts = []; foreach($categories as $c) $catOpts[$c['id']] = $c['name'];
$authOpts = []; foreach($authors as $a) $authOpts[$a['id']] = $a['name'];

$form_fields = [
    [
        'label' => 'Tiêu đề bài viết', 'name' => 'title', 'required' => true, 
        'width' => 'col-span-12 md:col-span-8', 'placeholder' => 'Nhập tiêu đề...'
    ],
    [
        'label' => 'Danh mục', 'name' => 'category_id', 'type' => 'select', 'required' => true,
        'width' => 'col-span-12 md:col-span-4', 'options' => $catOpts
    ],
    // --- Hàng 2 ---
    [
        'label' => 'Ảnh đại diện (Thumbnail)', 'name' => 'thumbnail', 'type' => 'file',
        'width' => 'col-span-12 md:col-span-6', 'required' => true, 'note' => 'Kích thước 800x600px'
    ],
    [
        'label' => 'Slug (URL)', 'name' => 'slug', 
        'width' => 'col-span-12 md:col-span-6', 'placeholder' => 'tu-dong-tao'
    ],
    // --- Hàng 3 ---
    [
        'label' => 'Mô tả ngắn (Summary)', 'name' => 'summary', 'type' => 'textarea', 'rows' => 3,
        'width' => 'col-span-12', 'placeholder' => 'Hiện ở card bài viết...'
    ],
    // --- Hàng 4: Nội dung chính ---
    [
        'label' => 'Nội dung chi tiết', 'name' => 'content', 'type' => 'textarea', 'rows' => 15,
        'width' => 'col-span-12', 'required' => true
    ],
    // --- Hàng 5: Cấu hình ---
    [
        'label' => 'Tác giả', 'name' => 'author_id', 'type' => 'select', 
        'width' => 'col-span-6 md:col-span-3', 'options' => $authOpts
    ],
    [
        'label' => 'Thời gian đọc (phút)', 'name' => 'reading_time', 'type' => 'text',
        'width' => 'col-span-6 md:col-span-3', 'placeholder' => '5'
    ],
    [
        'label' => 'Nổi bật', 'name' => 'is_featured', 'type' => 'select',
        'width' => 'col-span-6 md:col-span-3', 'options' => ['0' => 'Không', '1' => 'Có']
    ],
    [
        'label' => 'Trạng thái', 'name' => 'status', 'type' => 'select',
        'width' => 'col-span-6 md:col-span-3', 'options' => ['1' => 'Xuất bản', '0' => 'Nháp']
    ]
];

$form_title = $title;
$form_action = $isEdit ? "/admin/blog/update/{$post['id']}" : "/admin/blog/store";
$form_back_link = '/admin/blog';
$form_data = $data;

include 'includes/form.php';
?>

<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    // Tìm textarea có name="content" và thay thế bằng CKEditor
    CKEDITOR.replace('content', {
        height: 500,
        filebrowserUploadUrl: '/admin/upload-ckeditor' // Nếu bạn muốn làm upload ảnh trong bài viết sau này
    });
</script>

<?php include 'includes/admin-footer.php'; ?>