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