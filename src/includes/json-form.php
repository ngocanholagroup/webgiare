<?php
/**
 * COMPONENT: JSON TREE FORM BUILDER (ENHANCED UI)
 * Hiển thị form dưới dạng cây thư mục với đường nối chuẩn (Connector Lines).
 */
?>

<style>
    /* Container cho các cấp con */
    .tree-children-container {
        margin-left: 20px; /* Thụt đầu dòng */
        border-left: 1px solid #e2e8f0; /* Đường kẻ dọc chính (slate-200) */
    }

    /* Từng nhánh cây (Folder hoặc File) */
    .tree-branch {
        position: relative;
        padding-left: 24px; /* Chừa chỗ cho đường kẻ ngang */
    }

    /* Đường kẻ ngang (Connector) */
    .tree-branch::before {
        content: '';
        position: absolute;
        top: 18px; /* Căn chỉnh vị trí theo chiều dọc */
        left: 0;
        width: 20px;
        height: 1px;
        background-color: #cbd5e1; /* slate-300 */
    }

    /* Che đường kẻ dọc thừa của phần tử cuối cùng */
    .tree-children-container > .tree-branch:last-child {
        border-left: 1px solid white; /* Che đường kẻ dọc của cha bằng màu nền */
        margin-left: -1px; /* Kéo sang trái đè lên */
    }
    
    /* Vẽ lại móc chữ L cho phần tử cuối cùng */
    .tree-children-container > .tree-branch:last-child::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 1px;
        height: 18px; /* Chỉ cao đến điểm nối ngang */
        background-color: #e2e8f0; /* slate-200 */
    }
</style>

<div class="json-tree-wrapper bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden text-sm">
    
    <div class="bg-slate-50 border-b border-slate-200 px-4 py-2 flex justify-between items-center">
        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
            <i data-lucide="network" class="w-4 h-4"></i> Structure View
        </span>
        <div class="flex gap-2">
            <button type="button" onclick="expandAll()" class="text-[10px] bg-white border border-slate-300 px-2 py-1 rounded hover:bg-slate-50 text-slate-600 shadow-sm">Mở tất cả</button>
            <button type="button" onclick="collapseAll()" class="text-[10px] bg-white border border-slate-300 px-2 py-1 rounded hover:bg-slate-50 text-slate-600 shadow-sm">Thu gọn</button>
        </div>
    </div>

    <div class="p-4 pt-2 overflow-x-auto">
        <?php
        if (!function_exists('renderTreeNode')) {
            function renderTreeNode($data, $prefix, $level = 0) {
                // Container bao ngoài các phần tử con
                // Nếu level > 0 (không phải gốc) thì thêm class vẽ đường dọc
                $containerClass = $level > 0 ? "tree-children-container" : "";
                
                echo "<div class='{$containerClass}'>";

                foreach ($data as $key => $value) {
                    $inputName = $prefix . '[' . $key . ']';
                    $label = ucwords(str_replace(['_', '-'], ' ', $key));
                    
                    // Mỗi phần tử là một nhánh (Branch)
                    // Nếu level = 0 thì không cần padding vẽ dây
                    $branchClass = $level > 0 ? "tree-branch" : "mb-2"; 

                    echo "<div class='{$branchClass} relative'>";

                    // --- 1. NẾU LÀ FOLDER (ARRAY) ---
                    if (is_array($value)) {
                        $nodeId = md5($inputName);
                        ?>
                        <div class="flex items-center gap-2 cursor-pointer group hover:bg-slate-100 p-1.5 rounded transition-colors select-none mt-1" 
                             onclick="toggleNode('<?= $nodeId ?>', this)">
                            
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 icon-arrow"></i>
                            
                            <i data-lucide="folder" class="w-4 h-4 text-blue-500 fill-blue-100 group-hover:text-blue-600"></i>
                            
                            <span class="font-bold text-slate-700 text-xs font-mono"><?= $key ?></span>
                            <span class="text-[10px] text-slate-400 font-normal italic ml-1">(<?= $label ?>)</span>
                        </div>

                        <div id="<?= $nodeId ?>" class="tree-children" style="display: block;">
                            <?php renderTreeNode($value, $inputName, $level + 1); ?>
                        </div>
                        <?php
                    } 
                    // --- 2. NẾU LÀ FILE (VALUE) ---
                    else {
                        $val = htmlspecialchars((string)$value);
                        ?>
                        <div class="flex items-start gap-2 mt-1 group hover:bg-slate-50 p-1 rounded">
                            
                            <div class="flex-1 w-full grid grid-cols-12 gap-2 items-center">
                                <div class="col-span-12 md:col-span-3 lg:col-span-3 pt-1">
                                    <label class="block text-xs font-mono text-slate-600 truncate font-semibold" title="<?= $label ?>"><?= $key ?></label>
                                </div>

                                <div class="col-span-12 md:col-span-9 lg:col-span-9">
                                    <?php if (strlen($val) > 60 || preg_match('/(desc|content|intro)/i', $key)): ?>
                                        <textarea name="<?= $inputName ?>" rows="2" 
                                            class="w-full text-xs px-2 py-1.5 border border-slate-200 rounded bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-300 min-h-[38px] shadow-sm"><?= $val ?></textarea>
                                    <?php elseif (preg_match('/(color)/i', $key)): ?>
                                        <div class="flex items-center gap-2">
                                            <input type="color" value="<?= $val ?>" class="w-8 h-8 p-0.5 border border-slate-200 rounded cursor-pointer bg-white" onchange="this.nextElementSibling.value = this.value">
                                            <input type="text" name="<?= $inputName ?>" value="<?= $val ?>" class="w-24 text-xs px-2 py-1.5 border border-slate-200 rounded font-mono uppercase shadow-sm focus:border-blue-500 focus:outline-none">
                                        </div>
                                    <?php else: ?>
                                        <input type="text" name="<?= $inputName ?>" value="<?= $val ?>" 
                                            class="w-full text-xs px-2 py-1.5 border border-slate-200 rounded bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-300 font-mono text-slate-700 shadow-sm">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    echo "</div>"; // End .tree-branch
                }
                echo "</div>"; // End .tree-children-container
            }
        }

        // --- RENDER ---
        if (!empty($json_data) && is_array($json_data)) {
            renderTreeNode($json_data, $json_root_name ?? 'content');
        } else {
            echo '<div class="text-center text-slate-400 py-8 italic text-xs flex flex-col items-center">
                <i data-lucide="folder-open" class="w-8 h-8 mb-2 opacity-50"></i>
                Chưa có dữ liệu JSON
            </div>';
        }
        ?>
    </div>
</div>

<script>
    function toggleNode(id, headerEl) {
        const content = document.getElementById(id);
        const arrow = headerEl.querySelector('.icon-arrow');
        const folderIcon = headerEl.querySelector('[data-lucide="folder"]');
        
        if (content.style.display === 'none') {
            // Mở ra
            content.style.display = 'block';
            arrow.style.transform = 'rotate(0deg)';
            folderIcon.classList.remove('fill-slate-100', 'text-slate-400');
            folderIcon.classList.add('fill-blue-100', 'text-blue-500');
        } else {
            // Đóng lại
            content.style.display = 'none';
            arrow.style.transform = 'rotate(-90deg)';
            folderIcon.classList.remove('fill-blue-100', 'text-blue-500');
            folderIcon.classList.add('fill-slate-100', 'text-slate-400');
        }
    }

    function collapseAll() {
        document.querySelectorAll('.tree-children').forEach(el => {
            el.style.display = 'none';
            const header = el.previousElementSibling;
            if(header) {
                const arrow = header.querySelector('.icon-arrow');
                if(arrow) arrow.style.transform = 'rotate(-90deg)';
                const folderIcon = header.querySelector('[data-lucide="folder"]');
                if(folderIcon) {
                    folderIcon.classList.remove('fill-blue-100', 'text-blue-500');
                    folderIcon.classList.add('fill-slate-100', 'text-slate-400');
                }
            }
        });
    }

    function expandAll() {
        document.querySelectorAll('.tree-children').forEach(el => {
            el.style.display = 'block';
            const header = el.previousElementSibling;
            if(header) {
                const arrow = header.querySelector('.icon-arrow');
                if(arrow) arrow.style.transform = 'rotate(0deg)';
                const folderIcon = header.querySelector('[data-lucide="folder"]');
                if(folderIcon) {
                    folderIcon.classList.remove('fill-slate-100', 'text-slate-400');
                    folderIcon.classList.add('fill-blue-100', 'text-blue-500');
                }
            }
        });
    }
</script>