<?php include 'includes/admin-header.php'; ?>

<div id="tab-list" class="tab-panel active space-y-6">
    <?php
    // 1. Cấu hình Cột
    $columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        
        [
            'label' => 'Tên trang', 
            'type' => 'custom',
            'bold' => true,
            'callback' => function($row) {
                // Hiển thị Tên to, Slug nhỏ ở dưới
                return '<div>
                            <div class="text-slate-800 font-bold">' . htmlspecialchars($row['name']) . '</div>
                            <div class="text-xs text-blue-500 font-mono mt-0.5">/' . htmlspecialchars($row['slug']) . '</div>
                        </div>';
            }
        ],
        
        [
            'label' => 'SEO Title', 
            'key' => 'meta_title', 
            'class' => 'text-slate-500 text-sm truncate max-w-xs'
        ],
        
        [
            'label' => 'Cập nhật cuối', 
            'key' => 'updated_at', 
            'type' => 'datetime'
        ],
        
        [
            'label' => 'Hành động', 
            'type' => 'custom',
            'class' => 'text-right',
            'callback' => function($row) {
                // Nút Sửa thiết kế giống các trang khác
                return '<a href="/admin/page/edit/'.$row['id'].'" 
                           class="text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-1.5 rounded-md text-sm font-medium transition-colors inline-flex items-center gap-1.5">
                            <i data-lucide="layout" class="w-4 h-4"></i> Thiết kế
                        </a>';
            }
        ]
    ];

    // 2. Truyền dữ liệu
    $table_columns = $columns;
    $table_data = $pages;
    $table_title = 'Quản lý Trang tĩnh (Landing Page)';
    
    // Trang tĩnh thường cố định số lượng nên không cần nút Thêm/Xóa
    $create_link = null; 
    $search_placeholder = null; // Tắt tìm kiếm nếu ít trang
    $pagination = ['current' => 1, 'total' => 1]; 

    // 3. Gọi Component
    include 'includes/data-table.php';
    ?>
</div>

<?php include 'includes/admin-footer.php'; ?>