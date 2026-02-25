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
                <button type="button" onclick="window.location.href='<?= $form_back_link ?>'" 
                        class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">
                    <i class="fas fa-times mr-2"></i>Hủy bỏ
                </button>
                <button type="submit" form="main-form" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                    <i class="fas fa-save mr-2"></i>Lưu
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