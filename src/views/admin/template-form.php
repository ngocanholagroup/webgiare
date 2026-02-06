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
        'type'  => 'textarea', // Hoặc 'editor' nếu bạn đã tích hợp CKEditor
        'width' => 'col-span-12',
        'rows'  => 6
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

<?php include 'includes/admin-footer.php'; ?>