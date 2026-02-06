<?php 
// src/views/admin/contact.php
include 'includes/admin-header.php'; 
?>

<?php
// (Copy lại đoạn foreach $groupData của bạn vào đây)
$statusConfig = [
    'new'       => ['title' => 'Yêu cầu mới gửi', 'color' => 'text-orange-600'],
    'contacted' => ['title' => 'Đã liên hệ tư vấn', 'color' => 'text-blue-600'],
    'completed' => ['title' => 'Đơn hàng hoàn thành', 'color' => 'text-green-600'],
    'spam'      => ['title' => 'Tin nhắn rác', 'color' => 'text-slate-500 line-through']
];

foreach ($groupData as $statusKey => $group):
    $isActive = ($statusKey === 'new') ? 'active' : ''; 
?>
    <div id="tab-<?= $statusKey ?>" class="tab-panel <?= $isActive ?> space-y-6">
        <?php
        $table_columns = [
            ['label' => '#', 'type' => 'index', 'width' => '50px'],
            [
                'label' => 'Khách hàng', 'key' => 'full_name', 'bold' => true, 'sub_key' => 'phone'
            ],
            [
                'label' => 'Dịch vụ', 'key' => 'service_type', 'sub_key' => 'related_template'
            ],
            [
                'label' => 'Lời nhắn', 'type' => 'custom',
                'callback' => function ($row) {
                    return '<span class="text-slate-500 truncate block max-w-xs" title="' . $row['message'] . '">' . mb_strimwidth(htmlspecialchars($row['message']), 0, 60, "...") . '</span>';
                }
            ],
            ['label' => 'Ngày gửi', 'key' => 'created_at', 'type' => 'datetime'],
            [
                'label' => 'Hành động', 'type' => 'actions', 'class' => 'text-right',
                'edit_url' => '/admin/contact/detail/:id', 'delete_url' => '/admin/contact/delete/:id'
            ]
        ];

        $table_title = $statusConfig[$statusKey]['title'];
        $create_link = null; 
        $search_placeholder = 'Tìm trong tab ' . $statusConfig[$statusKey]['title'] . '...';
        $table_data = $group['data'];
        $thisTotalPages = ceil($group['total'] / $limit);
        $pagination = ['current' => $currentPage, 'total' => $thisTotalPages, 'url_params' => ['search' => $search]];

        include 'includes/data-table.php';
        ?>
    </div>
<?php endforeach; ?>


<div id="tab-services" class="tab-panel space-y-6">
    
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <h3 class="text-sm font-bold text-slate-700 whitespace-nowrap">Thêm dịch vụ mới:</h3>
        <form action="/admin/service/store" method="POST" class="flex-1 flex gap-2">
            <input type="text" name="name" required placeholder="VD: Thiết kế Website, SEO, Landing Page..." 
                   class="flex-1 px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500">
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-600 transition-colors">
                Thêm ngay
            </button>
        </form>
    </div>

    <?php
        $table_columns = [
            ['label' => '#', 'type' => 'index', 'width' => '50px'],
            ['label' => 'Tên dịch vụ', 'key' => 'name', 'bold' => true],
            [
                'label' => 'Ngày tạo', 'key' => 'created_at', 'type' => 'date', 'class' => 'text-slate-500'
            ],
            [
                'label' => 'Hành động',
                'type' => 'custom',
                'class' => 'text-right',
                'callback' => function ($row) {
                    return "<button onclick=\"if(confirm('Xóa dịch vụ này?')) window.location.href='/admin/service/delete/{$row['id']}'\" class='text-red-600 hover:bg-red-50 px-2 py-1 rounded text-xs font-bold transition-colors'>Xóa</button>";
                }
            ]
        ];

        $table_title = 'Danh sách dịch vụ hiện có';
        $create_link = null;
        $search_placeholder = null; // Tắt search ở tab này
        $table_data = $serviceList;
        $pagination = ['current' => 1, 'total' => 1]; 

        include 'includes/data-table.php';
    ?>
</div>

<?php include 'includes/admin-footer.php'; ?>