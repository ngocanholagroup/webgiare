<?php include 'includes/admin-header.php'; ?>

<?php
$isEdit = isset($admin);
$data = $admin ?? [];

$form_fields = [
    [
        'label' => 'Tên đăng nhập (Username)',
        'name'  => 'username',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'disabled' => $isEdit, // Không cho sửa username
        'placeholder' => 'VD: admin123'
    ],
    [
        'label' => $isEdit ? 'Mật khẩu mới (Để trống nếu không đổi)' : 'Mật khẩu',
        'name'  => 'password',
        'type'  => 'password',
        'required' => !$isEdit, // Tạo mới bắt buộc, Sửa thì ko
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => '••••••••'
    ],
    [
        'label' => 'Họ và tên',
        'name'  => 'full_name',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'Nguyễn Văn A'
    ],
    [
        'label' => 'Email',
        'name'  => 'email',
        'type'  => 'email', // Dùng type email để validate form
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'admin@example.com'
    ],
    [
        'label' => 'Ảnh đại diện (Avatar)',
        'name'  => 'avatar',
        'type'  => 'file',
        'width' => 'col-span-12',
        'note'  => 'Ảnh vuông, tối đa 2MB'
    ]
];

$form_title = $title;
$form_action = $isEdit ? "/admin/account/update/{$admin['id']}" : "/admin/account/store";
$form_back_link = '/admin/account';
$form_data = $data;

include 'includes/form.php';
?>

<?php include 'includes/admin-footer.php'; ?>