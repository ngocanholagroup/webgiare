<?php
/**
 * COMPONENT: JSON TREE FORM BUILDER
 * Hiển thị form dưới dạng cây thư mục (Tree View) có thể đóng mở.
 */

// CSS cho đường kẻ cây thư mục
$treeGuideClass = "border-l border-slate-300 ml-2.5 pl-4"; 
?>

<div class="json-tree-wrapper bg-white rounded-lg border border-slate-200 overflow-hidden text-sm">
    
    <div class="bg-slate-50 border-b border-slate-200 px-4 py-2 flex justify-between items-center">
        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Structure View</span>
        <div class="flex gap-2">
            <button type="button" onclick="expandAll()" class="text-[10px] bg-white border border-slate-300 px-2 py-1 rounded hover:bg-slate-50 text-slate-600">Mở tất cả</button>
            <button type="button" onclick="collapseAll()" class="text-[10px] bg-white border border-slate-300 px-2 py-1 rounded hover:bg-slate-50 text-slate-600">Thu gọn</button>
        </div>
    </div>

    <div class="p-4 pt-2">
        <?php
        if (!function_exists('renderTreeNode')) {
            function renderTreeNode($data, $prefix) {
                global $treeGuideClass;

                foreach ($data as $key => $value) {
                    $inputName = $prefix . '[' . $key . ']';
                    
                    // Format Key đẹp hơn: "title_highlight" -> "Title Highlight"
                    $label = ucwords(str_replace(['_', '-'], ' ', $key));
                    
                    // --- 1. NẾU LÀ MẢNG (FOLDER) ---
                    if (is_array($value)) {
                        $nodeId = md5($inputName); // ID duy nhất để toggle
                        ?>
                        <div class="tree-node relative mt-2">
                            <div class="flex items-center gap-2 cursor-pointer group hover:bg-slate-50 p-1.5 rounded -ml-2 select-none transition-colors" 
                                 onclick="toggleNode('<?= $nodeId ?>', this)">
                                
                                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 icon-arrow"></i>
                                
                                <i data-lucide="folder" class="w-4 h-4 text-blue-500 fill-blue-100"></i>
                                
                                <span class="font-bold text-slate-700 text-xs font-mono"><?= $key ?></span>
                                <span class="text-[10px] text-slate-400 font-normal italic ml-1">(<?= $label ?>)</span>
                            </div>

                            <div id="<?= $nodeId ?>" class="tree-children <?= $treeGuideClass ?> overflow-hidden transition-all duration-300 ease-in-out">
                                <?php renderTreeNode($value, $inputName); ?>
                            </div>
                        </div>
                        <?php
                    } 
                    // --- 2. NẾU LÀ GIÁ TRỊ (FILE/ITEM) ---
                    else {
                        $val = htmlspecialchars((string)$value);
                        ?>
                        <div class="tree-item flex items-start gap-2 mt-2 relative group hover:bg-slate-50 p-1 rounded -ml-2">
                            <div class="absolute -left-[17px] top-3.5 w-3 h-px bg-slate-300"></div>

                            <div class="pt-1.5 shrink-0 pl-1">
                                <?php if (strlen($val) > 100): ?>
                                    <i data-lucide="file-text" class="w-3.5 h-3.5 text-orange-500"></i>
                                <?php elseif (preg_match('/(image|img|src)/i', $key)): ?>
                                    <i data-lucide="image" class="w-3.5 h-3.5 text-purple-500"></i>
                                <?php else: ?>
                                    <i data-lucide="hash" class="w-3.5 h-3.5 text-slate-400"></i>
                                <?php endif; ?>
                            </div>

                            <div class="flex-1 w-full grid grid-cols-12 gap-2 items-center">
                                <div class="col-span-12 md:col-span-3 lg:col-span-2 pt-1">
                                    <label class="block text-xs font-mono text-slate-600 truncate" title="<?= $label ?>"><?= $key ?></label>
                                </div>

                                <div class="col-span-12 md:col-span-9 lg:col-span-10">
                                    <?php if (strlen($val) > 60 || preg_match('/(desc|content|intro)/i', $key)): ?>
                                        <textarea name="<?= $inputName ?>" rows="2" 
                                            class="w-full text-xs px-2 py-1.5 border border-slate-200 rounded bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-300 min-h-[38px]"><?= $val ?></textarea>
                                    <?php elseif (preg_match('/(color)/i', $key)): ?>
                                        <div class="flex items-center gap-2">
                                            <input type="color" value="<?= $val ?>" class="w-6 h-6 p-0 border-0 rounded cursor-pointer" onchange="this.nextElementSibling.value = this.value">
                                            <input type="text" name="<?= $inputName ?>" value="<?= $val ?>" class="w-24 text-xs px-2 py-1 border border-slate-200 rounded font-mono uppercase">
                                        </div>
                                    <?php else: ?>
                                        <input type="text" name="<?= $inputName ?>" value="<?= $val ?>" 
                                            class="w-full text-xs px-2 py-1.5 border border-slate-200 rounded bg-white focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-300 font-mono text-slate-700">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        }

        // --- RENDER ---
        if (!empty($json_data) && is_array($json_data)) {
            renderTreeNode($json_data, $json_root_name ?? 'content');
        } else {
            echo '<div class="text-center text-slate-400 py-4 italic text-xs">Trống</div>';
        }
        ?>
    </div>
</div>

<script>
    function toggleNode(id, headerEl) {
        const content = document.getElementById(id);
        const arrow = headerEl.querySelector('.icon-arrow');
        
        if (content.style.display === 'none') {
            // Mở ra
            content.style.display = 'block';
            arrow.style.transform = 'rotate(0deg)';
            headerEl.querySelector('[data-lucide="folder"]').classList.remove('fill-slate-100', 'text-slate-400');
            headerEl.querySelector('[data-lucide="folder"]').classList.add('fill-blue-100', 'text-blue-500');
        } else {
            // Đóng lại
            content.style.display = 'none';
            arrow.style.transform = 'rotate(-90deg)';
            headerEl.querySelector('[data-lucide="folder"]').classList.remove('fill-blue-100', 'text-blue-500');
            headerEl.querySelector('[data-lucide="folder"]').classList.add('fill-slate-100', 'text-slate-400');
        }
    }

    function collapseAll() {
        document.querySelectorAll('.tree-children').forEach(el => {
            el.style.display = 'none';
            // Xoay mũi tên ngang
            const header = el.previousElementSibling;
            if(header) {
                const arrow = header.querySelector('.icon-arrow');
                if(arrow) arrow.style.transform = 'rotate(-90deg)';
            }
        });
    }

    function expandAll() {
        document.querySelectorAll('.tree-children').forEach(el => {
            el.style.display = 'block';
            // Xoay mũi tên xuống
            const header = el.previousElementSibling;
            if(header) {
                const arrow = header.querySelector('.icon-arrow');
                if(arrow) arrow.style.transform = 'rotate(0deg)';
            }
        });
    }
</script>