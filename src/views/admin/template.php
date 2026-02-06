<?php include 'includes/admin-header.php'; ?>

<div id="tab-list" class="tab-panel active space-y-6">
    <?php
    $template_columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        [
            'label' => 'Tên giao diện / SKU', 
            'key' => 'name', 
            'bold' => true, 
            'sub_key' => 'sku'
        ],
        [
            'label' => 'Danh mục', 
            'key' => 'category_name'
        ],
        
        // [MỚI] Cột Lượt xem
        [
            'label' => 'Lượt xem', 
            'type' => 'custom',
            'class' => 'text-center',
            'callback' => function($row) {
                return '<div class="inline-flex items-center gap-1 px-2 py-1 rounded bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                            <i data-lucide="eye" class="w-3 h-3"></i> ' . number_format($row['views']) . '
                        </div>';
            }
        ],

        [
            'label' => 'Giá bán', 
            'type' => 'custom',
            'class' => 'text-right',
            'callback' => function($row) {
                $price = number_format($row['price']) . ' ₫';
                if ($row['sale_price'] > 0 && $row['sale_price'] < $row['price']) {
                    $sale = number_format($row['sale_price']) . ' ₫';
                    return "<div class='font-bold text-orange-600'>{$sale}</div>
                            <div class='text-xs text-slate-400 line-through'>{$price}</div>";
                }
                return "<div class='font-bold text-slate-700'>{$price}</div>";
            }
        ],
        [
            'label' => 'Điểm (D/M)', 
            'type' => 'custom',
            'class' => 'text-center',
            'callback' => function($row) {
                $dClass = $row['score_desktop'] >= 90 ? 'text-green-600' : 'text-yellow-600';
                $mClass = $row['score_mobile'] >= 90 ? 'text-green-600' : 'text-yellow-600';
                return "<span class='font-bold {$dClass}'>{$row['score_desktop']}</span>
                        <span class='text-slate-300 mx-1'>/</span>
                        <span class='font-bold {$mClass}'>{$row['score_mobile']}</span>";
            }
        ],
        [
            'label' => 'Trạng thái', 
            'key' => 'status', 
            'type' => 'status',
            'map' => ['1' => ['Hoạt động', 'text-green-700'], '0' => ['Ẩn', 'text-slate-500']]
        ],
        [
            'label' => 'Hành động', 
            'type' => 'actions', 
            'class' => 'text-right',
            'edit_url' => '/admin/template/edit/:id',
            'delete_url' => '/admin/template/delete/:id'
        ]
    ];

    $table_columns = $template_columns;
    $table_data = $templates;
    $table_title = 'Danh sách giao diện';
    $create_link = '/admin/template/create';
    $create_label = 'Thêm giao diện';
    $search_placeholder = 'Tìm tên hoặc mã SKU...';
    
    $pagination = [
        'current' => $currentPage,
        'total' => $totalPages,
        'url_params' => ['search' => $search]
    ];

    include 'includes/data-table.php';
    ?>
</div>

<div id="tab-category" class="tab-panel space-y-6">
    <?php
    // (Giữ nguyên phần config cột)
    $cat_columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        ['label' => 'Tên danh mục', 'key' => 'name', 'bold' => true, 'sub_key' => 'description'],
        ['label' => 'Slug', 'key' => 'slug', 'class' => 'font-mono text-slate-500'],
        ['label' => 'Số lượng', 'key' => 'total_templates', 'class' => 'text-center font-bold text-slate-700'],
        ['label' => 'Ngày tạo', 'key' => 'created_at', 'type' => 'date'],
        ['label' => 'Hành động', 'type' => 'actions', 'class' => 'text-right', 'edit_url' => '/admin/category/edit/:id', 'delete_url' => '/admin/category/delete/:id']
    ];

    $table_columns = $cat_columns;
    $table_data = $categories;
    $create_link = '/admin/category/create';
    $create_label = 'Thêm danh mục';
    
    // [QUAN TRỌNG] Đặt null để ẩn thanh tìm kiếm
    $search_placeholder = null; 
    
    // Vì danh mục thường ít, ta set luôn pagination giả để ẩn phân trang nếu muốn
    $pagination = ['current' => 1, 'total' => 1, 'url_params' => []];

    include 'includes/data-table.php';
    ?>
</div>

<?php include 'includes/admin-footer.php'; ?>