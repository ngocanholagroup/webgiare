<?php include 'includes/admin-header.php'; ?>

<div id="tab-list" class="tab-panel active space-y-6">
    <?php
    $columns = [
        ['label' => '#', 'type' => 'index', 'width' => '50px'],
        
        // Cột Username + Avatar
        [
            'label' => 'Tài khoản', 
            'type' => 'custom',
            'callback' => function($row) {
                $avatar = !empty($row['avatar']) ? $row['avatar'] : 'https://ui-avatars.com/api/?background=random&name='.urlencode($row['full_name']);
                
                $html = '<div class="flex items-center gap-3">
                            <img src="'.$avatar.'" class="w-9 h-9 rounded-full object-cover border border-slate-200">
                            <div>
                                <div class="font-bold text-slate-800">'.htmlspecialchars($row['username']).'</div>';
                
                if ($row['id'] == $_SESSION['admin_id']) {
                    $html .= '<span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded font-bold uppercase">Bạn</span>';
                } elseif ($row['id'] == 1) {
                    $html .= '<span class="text-[10px] bg-purple-100 text-purple-700 px-1.5 py-0.5 rounded font-bold uppercase">Super Admin</span>';
                }
                
                $html .= '  </div>
                        </div>';
                return $html;
            }
        ],
        
        ['label' => 'Họ và tên', 'key' => 'full_name', 'class' => 'text-slate-700'],
        ['label' => 'Email', 'key' => 'email', 'class' => 'font-mono text-slate-500'],
        
        [
            'label' => 'Lần đăng nhập cuối', 
            'type' => 'custom',
            'callback' => function($row) {
                if ($row['last_login']) {
                    return '<div class="text-sm text-slate-500">' . date('d/m/Y', strtotime($row['last_login'])) . '</div>
                            <div class="text-xs text-slate-400">' . date('H:i', strtotime($row['last_login'])) . '</div>';
                }
                return '<span class="text-slate-400 italic text-xs">Chưa đăng nhập</span>';
            }
        ],
        
        [
            'label' => 'Hành động', 
            'type' => 'custom', 
            'class' => 'text-right',
            'callback' => function($row) {
                $editBtn = '<a href="/admin/account/edit/'.$row['id'].'" class="text-blue-600 hover:underline font-medium text-sm">Sửa</a>';
                
                $deleteBtn = '';
                // Không cho xóa chính mình và Super Admin (ID=1)
                if ($row['id'] != $_SESSION['admin_id'] && $row['id'] != 1) {
                    $deleteBtn = '<span class="text-slate-300 mx-2">|</span>
                                  <a href="/admin/account/delete/'.$row['id'].'" onclick="return confirm(\'Xóa tài khoản này?\')" class="text-red-600 hover:underline font-medium text-sm">Xóa</a>';
                }
                return $editBtn . $deleteBtn;
            }
        ]
    ];

    $table_columns = $columns;
    $table_data = $admins;
    $table_title = 'Danh sách quản trị viên';
    $create_link = '/admin/account/create';
    $create_label = 'Thêm quản trị viên';
    $search_placeholder = 'Tìm username, tên...';
    $pagination = ['current' => $currentPage, 'total' => $totalPages, 'url_params' => ['search' => $search]];

    include 'includes/data-table.php';
    ?>
</div>

<?php include 'includes/admin-footer.php'; ?>