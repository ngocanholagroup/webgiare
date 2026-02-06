<?php include 'includes/admin-header.php'; ?>
<?php
$isEdit = isset($author);
$form_fields = [
    ['label' => 'Tên tác giả', 'name' => 'name', 'required' => true, 'width' => 'col-span-12 md:col-span-6'],
    ['label' => 'Chức danh', 'name' => 'title', 'width' => 'col-span-12 md:col-span-6', 'placeholder' => 'VD: Content Writer'],
    ['label' => 'Avatar', 'name' => 'avatar', 'type' => 'file', 'width' => 'col-span-12', 'note' => 'Ảnh vuông, tối đa 2MB'],
    ['label' => 'Giới thiệu ngắn (Bio)', 'name' => 'bio', 'type' => 'textarea', 'rows' => 3, 'width' => 'col-span-12']
];
$form_title = $title;
$form_action = $isEdit ? "/admin/author/update/{$author['id']}" : "/admin/author/store";
$form_back_link = '/admin/blog?tab=authors';
$form_data = $author ?? [];
include 'includes/form.php';
?>
<?php include 'includes/admin-footer.php'; ?>