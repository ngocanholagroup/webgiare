<?php 
// src/views/admin/backup.php
include 'includes/admin-header.php'; 
?>

<div id="tab-list" class="tab-panel active space-y-6">
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
            <?= htmlspecialchars($_SESSION['error']) ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex justify-between items-center gap-4">
        <div>
            <h3 class="text-sm font-bold text-slate-700 whitespace-nowrap">Cấu hình hệ thống</h3>
            <p class="text-xs text-slate-500 mt-1">Hệ thống tự động sao lưu lúc 02:00 sáng mỗi ngày. Giữ tối đa 7 bản sao lưu gần nhất.</p>
        </div>
        <form action="/admin/backup/create" method="POST" onsubmit="return confirm('Quá trình tạo sao lưu có thể mất vài phút. Bạn có muốn tiếp tục?');">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                Tạo sao lưu mới ngay
            </button>
        </form>
    </div>

    <?php
        $table_columns = [
            ['label' => 'Thời gian', 'key' => 'display_date', 'bold' => true],
            [
                'label' => 'Các file dữ liệu',
                'type' => 'custom',
                'callback' => function($row) {
                    $html = '<ul class="list-disc pl-4 space-y-1 text-sm text-slate-600">';
                    foreach ($row['files'] as $file) {
                        if ($file['size'] < 1024 * 1024) {
                            $sizeDisplay = round($file['size'] / 1024, 2) . ' KB';
                        } else {
                            $sizeDisplay = round($file['size'] / 1024 / 1024, 2) . ' MB';
                        }
                        $html .= "<li>" . htmlspecialchars($file['name']) . " ({$sizeDisplay})</li>";
                    }
                    $html .= '</ul>';
                    return $html;
                }
            ],
            [
                'label' => 'Tổng dung lượng',
                'type' => 'custom',
                'callback' => function($row) {
                    if ($row['size'] < 1024 * 1024) {
                        $totalDisplay = round($row['size'] / 1024, 2) . ' KB';
                    } else {
                        $totalDisplay = round($row['size'] / 1024 / 1024, 2) . ' MB';
                    }
                    return "<span class='text-sm text-slate-600 font-medium'>{$totalDisplay}</span>";
                }
            ],
            [
                'label' => 'Hành động',
                'type' => 'custom',
                'class' => 'text-right',
                'callback' => function($row) {
                    $date = htmlspecialchars($row['id']);
                    $displayDate = htmlspecialchars($row['display_date']);
                    return "
                    <form action='/admin/backup/restore' method='POST' class='inline-block' onsubmit=\"return confirm('CẢNH BÁO: Quá trình này sẽ GHI ĐÈ toàn bộ dữ liệu hiện tại bằng dữ liệu từ bản sao lưu ngày {$displayDate}. Bạn có CHẮC CHẮN muốn thực hiện?');\">
                        <input type='hidden' name='date' value='{$date}'>
                        <button type='submit' class='inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700 hover:bg-amber-200 text-sm font-bold rounded-lg transition-colors'>
                            <i data-lucide='rotate-ccw' class='w-4 h-4'></i>
                            Khôi phục
                        </button>
                    </form>";
                }
            ]
        ];

        $table_title = 'Danh sách bản sao lưu';
        $create_link = null;
        $search_placeholder = null; // Ẩn thanh tìm kiếm
        $table_data = $backups;
        
        // Cấu hình dummy pagination (1 trang) vì số lượng backup tối đa là 7 bản.
        $pagination = ['current' => 1, 'total' => 1]; 

        include 'includes/data-table.php';
    ?>
</div>

<?php include 'includes/admin-footer.php'; ?>
