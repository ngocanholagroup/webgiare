<?php include 'includes/admin-header.php'; ?>

<div id="tab-posts" class="tab-panel active space-y-6">
    <?php
    $post_columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        [
            'label' => 'Tiêu đề bài viết', 
            'type' => 'custom',
            'bold' => true,
            'callback' => function($row) {
                $html = htmlspecialchars($row['title']);
                if ($row['is_featured']) {
                    $html .= ' <span class="text-orange-500 text-xs font-normal ml-1">(Nổi bật)</span>';
                }
                $html .= '<div class="text-xs text-slate-400 mt-0.5 font-normal">/' . htmlspecialchars($row['slug']) . '</div>';
                return $html;
            }
        ],
        [
            'label' => 'Danh mục', 'key' => 'category_name', 'class' => 'text-slate-600'
        ],
        
        // [MỚI] Cột Lượt xem
        [
            'label' => 'Lượt xem', 
            'type' => 'custom',
            'class' => 'text-center',
            'callback' => function($row) {
                return '<div class="inline-flex items-center gap-1 px-2 py-1 rounded bg-slate-50 text-slate-500 text-xs font-medium">
                            <i data-lucide="eye" class="w-3 h-3"></i> ' . number_format($row['views']) . '
                        </div>';
            }
        ],

        [
            'label' => 'Tác giả', 'key' => 'author_name', 'class' => 'text-slate-600'
        ],
        [
            'label' => 'Ngày đăng', 'key' => 'published_at', 'type' => 'date'
        ],
        [
            'label' => 'Trạng thái', 'key' => 'status', 'type' => 'status',
            'map' => ['1' => ['Published', 'text-green-700'], '0' => ['Draft', 'text-slate-500']]
        ],
        [
            'label' => 'Hành động', 'type' => 'actions', 'class' => 'text-right',
            'edit_url' => '/admin/blog/edit/:id', 'delete_url' => '/admin/blog/delete/:id'
        ]
    ];

    $table_columns = $post_columns;
    $table_data = $posts;
    $create_link = '/admin/blog/create';
    $create_label = 'Viết bài mới';
    $search_placeholder = null;
    $pagination = ['current' => $currentPage, 'total' => $totalPages, 'url_params' => ['search' => $search]];

    include 'includes/data-table.php';
    ?>
</div>

<div id="tab-categories" class="tab-panel space-y-6">
    <?php
    // (Giữ nguyên phần Blog Categories)
    $cat_columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        ['label' => 'Tên danh mục', 'key' => 'name', 'bold' => true],
        ['label' => 'Slug', 'key' => 'slug', 'class' => 'font-mono text-slate-500 text-sm'],
        ['label' => 'Số bài', 'key' => 'total_posts', 'class' => 'text-center font-bold text-slate-700'],
        ['label' => 'Ngày tạo', 'key' => 'created_at', 'type' => 'date'],
        ['label' => 'Hành động', 'type' => 'actions', 'class' => 'text-right', 'edit_url' => '/admin/blog-category/edit/:id', 'delete_url' => '/admin/blog-category/delete/:id']
    ];

    $table_columns = $cat_columns;
    $table_data = $categories;
    $create_link = '/admin/blog-category/create';
    $create_label = 'Thêm danh mục';
    $search_placeholder = null;
    $pagination = ['current' => 1, 'total' => 1];

    include 'includes/data-table.php';
    ?>
</div>

<div id="tab-authors" class="tab-panel space-y-6">
    <?php
    // (Giữ nguyên phần Authors)
    $auth_columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        ['label' => 'Tên tác giả', 'type' => 'custom', 'callback' => function($row) {
            $avatar = !empty($row['avatar']) ? $row['avatar'] : 'https://ui-avatars.com/api/?name='.urlencode($row['name']);
            return '<div class="flex items-center gap-3"><img src="'.$avatar.'" class="w-8 h-8 rounded-full object-cover border border-slate-200"><span class="font-bold text-slate-800">'.htmlspecialchars($row['name']).'</span></div>';
        }],
        ['label' => 'Chức danh', 'key' => 'title', 'class' => 'text-slate-600'],
        ['label' => 'Bio', 'type' => 'custom', 'callback' => function($row) {
            return '<span class="text-slate-500 truncate block max-w-xs" title="'.htmlspecialchars($row['bio']).'">' . htmlspecialchars($row['bio'] ?? '') . '</span>';
        }],
        ['label' => 'Số bài', 'key' => 'total_posts', 'class' => 'text-center font-bold text-slate-700'],
        ['label' => 'Hành động', 'type' => 'actions', 'class' => 'text-right', 'edit_url' => '/admin/author/edit/:id', 'delete_url' => '/admin/author/delete/:id']
    ];

    $table_columns = $auth_columns;
    $table_data = $authors;
    $create_link = '/admin/author/create';
    $create_label = 'Thêm tác giả';
    $search_placeholder = null;
    $pagination = ['current' => 1, 'total' => 1];

    include 'includes/data-table.php';
    ?>
</div>

<?php include 'includes/admin-footer.php'; ?>