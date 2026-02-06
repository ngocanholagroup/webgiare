<?php
/**
 * COMPONENT: DATA TABLE (TAILWIND CSS ONLY)
 * Updated: Ẩn thanh tìm kiếm nếu $search_placeholder = null
 */

// Kiểm tra xem có cần hiển thị thanh công cụ không (Có Search HOẶC Có nút Thêm mới)
$show_toolbar = !empty($search_placeholder) || !empty($create_link);
?>

<?php if ($show_toolbar): ?>
<div class="flex flex-col md:flex-row justify-between gap-4 bg-white p-4 rounded-xl border border-slate-200 shadow-sm mb-6">
    
    <?php if (!empty($search_placeholder)): ?>
    <form method="GET" action="" class="relative flex-1 max-w-md">
        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
        <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
            class="w-full pl-10 pr-4 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all"
            placeholder="<?= $search_placeholder ?>">
            
        <?php if(isset($pagination['url_params'])): foreach($pagination['url_params'] as $key => $val): ?>
            <?php if($key !== 'search' && $key !== 'page' && !empty($val)): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= htmlspecialchars($val) ?>">
            <?php endif; ?>
        <?php endforeach; endif; ?>
    </form>
    <?php else: ?>
        <div></div>
    <?php endif; ?>

    <?php if (!empty($create_link)): ?>
    <a href="<?= $create_link ?>" class="flex items-center justify-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-md shadow-orange-500/20">
        <i data-lucide="plus" class="w-4 h-4"></i> <?= $create_label ?? 'Thêm mới' ?>
    </a>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <?php foreach ($table_columns as $col): ?>
                        <th class="px-6 py-4 text-xs font-semibold uppercase text-slate-500 whitespace-nowrap <?= $col['class'] ?? '' ?>" 
                            style="<?= isset($col['width']) ? "width: {$col['width']}" : '' ?>">
                            <?= $col['label'] ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            
            <tbody class="divide-y divide-slate-100">
                <?php if (!empty($table_data)): foreach ($table_data as $index => $row): ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <?php foreach ($table_columns as $col): ?>
                            <td class="px-6 py-4 text-sm text-slate-700 align-middle <?= $col['class'] ?? '' ?>">
                                <?php 
                                $key = $col['key'] ?? null;
                                $val = $key ? ($row[$key] ?? '') : '';

                                switch ($col['type'] ?? 'text') {
                                    case 'index': // STT
                                        $currentPage = $pagination['current'] ?? 1;
                                        echo '<span class="text-slate-400">' . ($index + 1 + (($currentPage - 1) * 15)) . '</span>';
                                        break;

                                    case 'money': // Tiền tệ
                                        echo '<span class="font-bold text-slate-700">' . number_format($val) . ' ₫</span>';
                                        break;
                                    
                                    case 'date': // Ngày
                                        echo '<span class="text-slate-500">' . date('d/m/Y', strtotime($val)) . '</span>';
                                        break;
                                    
                                    case 'datetime': // Ngày giờ
                                        echo '<div>' . date('d/m/Y', strtotime($val)) . '</div>';
                                        echo '<div class="text-xs text-slate-400 mt-0.5">' . date('H:i', strtotime($val)) . '</div>';
                                        break;

                                    case 'status': // Trạng thái (Text màu)
                                        // Format map: 'value' => ['Label', 'Tailwind Class']
                                        $map = $col['map'] ?? ['1' => ['Active', 'text-green-600'], '0' => ['Inactive', 'text-slate-500']];
                                        $st = $map[$val] ?? ['Unknown', 'text-slate-400'];
                                        echo "<span class='font-bold {$st[1]}'>{$st[0]}</span>";
                                        break;

                                    case 'actions': // Hành động Sửa/Xóa (Text Link)
                                        $id = $row['id'];
                                        $edit_url = str_replace(':id', $id, $col['edit_url'] ?? '#');
                                        $delete_url = str_replace(':id', $id, $col['delete_url'] ?? '#');
                                        
                                        echo "<div class='flex items-center justify-end gap-1'>";
                                        if(!empty($col['edit_url'])) 
                                            echo "<a href='{$edit_url}' class='text-blue-600 hover:text-blue-800 hover:underline font-medium'>Sửa</a>";
                                        
                                        if(!empty($col['edit_url']) && !empty($col['delete_url'])) 
                                            echo "<span class='text-slate-300 mx-2'>/</span>";
                                        
                                        if(!empty($col['delete_url'])) 
                                            echo "<button onclick=\"if(confirm('Bạn chắc chắn muốn xóa?')) window.location.href='{$delete_url}'\" class='text-red-600 hover:text-red-800 hover:underline font-medium'>Xóa</button>";
                                        echo "</div>";
                                        break;
                                    
                                    case 'custom': // Callback
                                        if (is_callable($col['callback'])) echo $col['callback']($row);
                                        break;

                                    default: // Text mặc định
                                        $text = htmlspecialchars($val);
                                        // Nếu có cấu hình bold
                                        if (!empty($col['bold'])) echo "<span class='font-medium text-slate-900'>{$text}</span>";
                                        else echo $text;
                                        
                                        // Subtext (dòng nhỏ bên dưới)
                                        if (isset($col['sub_key']) && !empty($row[$col['sub_key']])) {
                                            echo "<div class='text-xs text-slate-400 mt-1'>" . htmlspecialchars($row[$col['sub_key']]) . "</div>";
                                        }
                                        break;
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="<?= count($table_columns) ?>" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-slate-50 p-4 rounded-full mb-3">
                                    <i data-lucide="inbox" class="w-6 h-6 text-slate-400"></i>
                                </div>
                                <p class="text-sm font-medium">Không tìm thấy dữ liệu nào.</p>
                                <?php if(!empty($_GET['search'])): ?>
                                    <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="text-orange-600 text-xs mt-2 hover:underline">Xóa bộ lọc</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pagination['total'] > 1): ?>
    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex items-center justify-between">
        <span class="text-xs text-slate-500 font-medium">
            Trang <span class="text-slate-900"><?= $pagination['current'] ?></span> / <?= $pagination['total'] ?>
        </span>
        
        <div class="flex items-center gap-1">
            <?php 
            $buildUrl = function($p) use ($pagination) {
                $params = $pagination['url_params'] ?? [];
                $params['page'] = $p;
                return '?' . http_build_query($params);
            };
            $cur = $pagination['current'];
            $tot = $pagination['total'];
            ?>
            
            <a href="<?= $buildUrl(max(1, $cur - 1)) ?>" class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-500 hover:border-orange-500 hover:text-orange-600 transition-colors <?= $cur == 1 ? 'pointer-events-none opacity-50' : '' ?>">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
            </a>

            <?php for($i = 1; $i <= $tot; $i++): ?>
                <?php if ($i == $cur): ?>
                    <span class="w-8 h-8 flex items-center justify-center rounded bg-orange-600 text-white text-xs font-bold shadow-sm cursor-default"><?= $i ?></span>
                <?php elseif ($i <= 3 || $i >= $tot - 1 || abs($i - $cur) <= 1): ?>
                    <a href="<?= $buildUrl($i) ?>" class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-600 text-xs hover:border-orange-500 hover:text-orange-600 transition-colors"><?= $i ?></a>
                <?php elseif ($i == 4 && $cur > 5): ?>
                    <span class="w-8 h-8 flex items-center justify-center text-slate-400 text-xs">...</span>
                <?php endif; ?>
            <?php endfor; ?>

            <a href="<?= $buildUrl(min($tot, $cur + 1)) ?>" class="w-8 h-8 flex items-center justify-center rounded border border-slate-200 bg-white text-slate-500 hover:border-orange-500 hover:text-orange-600 transition-colors <?= $cur == $tot ? 'pointer-events-none opacity-50' : '' ?>">
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>