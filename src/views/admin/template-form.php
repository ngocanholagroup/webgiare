<?php include 'includes/admin-header.php'; ?>

<?php
// --- 1. CHUẨN BỊ DỮ LIỆU ĐẦU VÀO ---

$isEdit = isset($template); // Kiểm tra đang là chế độ Sửa hay Thêm mới
$data = $template ?? [];    // Dữ liệu điền vào form

// Xử lý dữ liệu Gallery để hiển thị ảnh cũ (kèm ID để xóa)
$galleryData = [];
if (!empty($gallery)) {
    foreach ($gallery as $img) {
        $galleryData[] = [
            'id'  => $img['id'],        // ID để tạo link xóa
            'src' => $img['image_url']  // Đường dẫn ảnh để hiển thị
        ];
    }
}
// Gán vào key 'gallery_files' để component form.php nhận diện
$data['gallery_files'] = $galleryData; 

// Xử lý danh sách Danh mục cho Dropdown
$categoryOptions = [];
if (!empty($categories)) {
    foreach ($categories as $cat) {
        $categoryOptions[$cat['id']] = $cat['name'];
    }
}

// --- 2. CẤU HÌNH CÁC TRƯỜNG NHẬP LIỆU (FIELDS) ---

$form_fields = [
    // === NHÓM 1: THÔNG TIN CƠ BẢN ===
    [
        'label' => 'Tên giao diện',
        'name'  => 'name',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-8',
        'placeholder' => 'VD: Bất động sản cao cấp...'
    ],
    [
        'label' => 'Mã SKU (Mã sản phẩm)',
        'name'  => 'sku',
        'type'  => 'text',
        'required' => true,
        'width' => 'col-span-12 md:col-span-4',
        'placeholder' => 'VD: THEME-001'
    ],

    // === NHÓM 2: ẢNH ĐẠI DIỆN ===
    [
        'label' => 'Ảnh Desktop (Ảnh chính)',
        'name'  => 'image_desktop',
        'type'  => 'file',
        'required' => !$isEdit, // Chỉ bắt buộc khi thêm mới
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Kích thước chuẩn: 1200x800px (Tỉ lệ 3:2 hoặc 16:10).'
    ],
    [
        'label' => 'Ảnh Mobile (Demo điện thoại)',
        'name'  => 'image_mobile',
        'type'  => 'file',
        'required' => !$isEdit, // Chỉ bắt buộc khi thêm mới
        'width' => 'col-span-12 md:col-span-6',
        'note'  => 'Kích thước chuẩn: 400x800px (Tỉ lệ 1:2).'
    ],

    // === NHÓM 3: THƯ VIỆN ẢNH (GALLERY) ===
    [
        'label'    => 'Thư viện ảnh phụ (Screenshots các trang con)',
        'name'     => 'gallery_files', 
        'type'     => 'file',
        'multiple' => true,  // Cho phép chọn nhiều file cùng lúc
        'width'    => 'col-span-12',
        'delete_image_url' => '/admin/template/delete-image/:id',
        'note'     => 'Giữ phím Ctrl (hoặc Command) để chọn nhiều ảnh. Ảnh cũ đã lưu sẽ hiển thị bên dưới.'
    ],

    // === NHÓM 4: PHÂN LOẠI & ĐƯỜNG DẪN ===
    [
        'label'   => 'Danh mục',
        'name'    => 'category_id',
        'type'    => 'select',
        'required'=> true,
        'width'   => 'col-span-12 md:col-span-6',
        'options' => $categoryOptions
    ],
    [
        'label' => 'Slug (Đường dẫn SEO)',
        'name'  => 'slug',
        'type'  => 'text',
        'required' => false, // [QUAN TRỌNG] Không bắt buộc
        'width' => 'col-span-12 md:col-span-6',
        'placeholder' => 'tu-dong-tao-neu-de-trong',
        'note' => 'Để trống hệ thống sẽ tự động tạo từ Tên giao diện.'
    ],

    // === NHÓM 5: GIÁ & DEMO ===
    [
        'label' => 'Giá gốc (VNĐ)',
        'name'  => 'price',
        'type'  => 'text', // Dùng text để format tiền nếu cần, nhưng lưu DB là int
        'required' => true,
        'width' => 'col-span-12 md:col-span-4',
        'placeholder' => 'VD: 5000000'
    ],
    [
        'label' => 'Giá khuyến mãi (VNĐ)',
        'name'  => 'sale_price',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-4',
        'placeholder' => 'Để 0 nếu không giảm'
    ],
    [
        'label' => 'Link Demo Online',
        'name'  => 'demo_url',
        'type'  => 'text',
        'width' => 'col-span-12 md:col-span-4',
        'placeholder' => 'https://demo.example.com'
    ],

    // === NHÓM 6: CHỈ SỐ & TRẠNG THÁI ===
    [
        'label' => 'Điểm PageSpeed Desktop',
        'name'  => 'score_desktop',
        'type'  => 'text',
        'width' => 'col-span-4',
        'placeholder' => '100'
    ],
    [
        'label' => 'Điểm PageSpeed Mobile',
        'name'  => 'score_mobile',
        'type'  => 'text',
        'width' => 'col-span-4',
        'placeholder' => '95'
    ],
    [
        'label'   => 'Trạng thái hiển thị',
        'name'    => 'status',
        'type'    => 'select',
        'width'   => 'col-span-4',
        'options' => ['1' => 'Hiện', '0' => 'Ẩn']
    ],

    // === NHÓM 7: MÔ TẢ ===
    [
        'label' => 'Mô tả chi tiết',
        'name'  => 'description',
        'type'  => 'textarea',
        'width' => 'col-span-12',
        'rows'  => 15,
        'required' => false,
        'class' => 'tinymce-editor',
        'id' => 'description-editor'
    ]
];

// --- 3. CẤU HÌNH THÔNG TIN FORM ---

$form_title = $isEdit ? 'Cập nhật giao diện: ' . htmlspecialchars($template['name']) : 'Thêm giao diện mới';
$form_action = $isEdit ? '/admin/template/update/' . $template['id'] : '/admin/template/store';
$form_back_link = '/admin/template';
$form_data = $data;

// --- 4. GỌI COMPONENT HIỂN THỊ ---
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