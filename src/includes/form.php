<?php
/**
 * COMPONENT: DYNAMIC FORM V4
 * Hỗ trợ: Upload Single (Avatar), Upload Multiple (Gallery), Auto Enctype, Old Value Preservation
 */

// 1. Kiểm tra input file để thêm enctype
$hasFile = false;
if (isset($form_fields) && is_array($form_fields)) {
    foreach ($form_fields as $f) {
        if (isset($f['type']) && $f['type'] === 'file') {
            $hasFile = true;
            break;
        }
    }
}
?>

<div class="max-w-5xl mx-auto">
    
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-xl font-bold text-slate-800"><?= $form_title ?? 'Form dữ liệu' ?></h1>
            <?php if(isset($form_subtitle)): ?>
                <p class="text-sm text-slate-500 mt-1"><?= $form_subtitle ?></p>
            <?php endif; ?>
        </div>
        <?php if (isset($form_back_link)): ?>
            <a href="<?= $form_back_link ?>" class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại
            </a>
        <?php endif; ?>
    </div>

    <form action="<?= $form_action ?>" method="POST" <?= $hasFile ? 'enctype="multipart/form-data"' : '' ?> 
          class="bg-white p-6 md:p-8 rounded-xl border border-slate-200 shadow-sm">

        <div class="grid grid-cols-12 gap-6">
            <?php foreach ($form_fields as $field):
                $key = $field['name'];
                // Lấy giá trị: Ưu tiên $_POST (khi lỗi) -> $form_data (khi edit) -> Rỗng
                $val = $_POST[$key] ?? ($form_data[$key] ?? '');
                
                $type = $field['type'] ?? 'text';
                $width = $field['width'] ?? 'col-span-12';
                $required = $field['required'] ?? false;
                $disabled = $field['disabled'] ?? false;
                $placeholder = $field['placeholder'] ?? '';
                $note = $field['note'] ?? '';
                $isMultiple = $field['multiple'] ?? false;
            ?>
                <div class="<?= $width ?>">
                    
                    <?php if ($type !== 'hidden'): ?>
                    <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">
                        <?= $field['label'] ?>
                        <?php if ($required): ?> <span class="text-red-500">*</span> <?php endif; ?>
                    </label>
                    <?php endif; ?>

                    <?php switch ($type): 
                        case 'textarea': ?>
                            <textarea name="<?= $key ?>" rows="<?= $field['rows'] ?? 4 ?>" 
                                <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?>
                                class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-400"
                                placeholder="<?= $placeholder ?>"><?= htmlspecialchars($val) ?></textarea>
                            <?php break; ?>

                        <?php case 'select': ?>
                            <div class="relative">
                                <select name="<?= $key ?>" 
                                    <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?>
                                    class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 bg-white appearance-none cursor-pointer">
                                    <?php foreach ($field['options'] as $optVal => $optLabel): ?>
                                        <option value="<?= $optVal ?>" <?= (string)$val === (string)$optVal ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($optLabel) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-3 top-3 w-4 h-4 text-slate-400 pointer-events-none"></i>
                            </div>
                            <?php break; ?>

                        <?php case 'file': 
                            $inputId = "input_" . $key;
                            ?>
                            
                            <?php if ($isMultiple): 
                                // === 1. UPLOAD NHIỀU FILE (GALLERY) === 
                                $previewContainerId = "gallery_preview_" . $key;
                            ?>
                                <div class="border border-dashed border-slate-300 rounded-xl p-4 bg-slate-50">
                                    <input type="file" name="<?= $key ?>[]" id="<?= $inputId ?>" multiple accept="image/*"
                                           onchange="previewGallery(this, '<?= $previewContainerId ?>')"
                                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer mb-4">
                                    
                                    <div class="grid grid-cols-4 md:grid-cols-6 gap-4" id="<?= $previewContainerId ?>">
                                        <?php if (!empty($val) && is_array($val)): foreach($val as $imgItem): 
                                            $src = is_array($imgItem) ? $imgItem['src'] : $imgItem;
                                            $id = is_array($imgItem) ? $imgItem['id'] : null;
                                        ?>
                                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-slate-200 bg-white">
                                                <img src="<?= htmlspecialchars($src) ?>" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                    <?php if($id): ?>
                                                        <a href="<?= isset($delete_image_url) ? str_replace(':id', $id, $delete_image_url) : '#' ?>" 
                                                           onclick="return confirm('Xóa ảnh này?')"
                                                           class="bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-white text-xs">Đã lưu</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; endif; ?>
                                    </div>
                                </div>

                            <?php else: 
                                // === 2. UPLOAD 1 FILE (AVATAR/BANNER) ===
                                $previewId = "preview_" . $key;
                                $iconId = "icon_" . $key;
                                // $val lúc này là đường dẫn ảnh (string)
                                $hasImage = !empty($val) && is_string($val);
                            ?>
                                <div class="flex flex-col sm:flex-row gap-4 items-start p-4 border border-slate-200 rounded-xl bg-slate-50">
                                    <div class="shrink-0 w-24 h-24 bg-white border border-slate-300 rounded-full overflow-hidden flex items-center justify-center relative shadow-sm group">
                                        <img id="<?= $previewId ?>" src="<?= $hasImage ? htmlspecialchars($val) : '' ?>"
                                             class="w-full h-full object-cover <?= $hasImage ? '' : 'hidden' ?>">
                                        
                                        <i id="<?= $iconId ?>" data-lucide="image"
                                           class="w-8 h-8 text-slate-300 <?= $hasImage ? 'hidden' : '' ?>"></i>
                                    </div>

                                    <div class="flex-1 w-full">
                                        <input type="file" name="<?= $key ?>" id="<?= $inputId ?>" accept="image/*"
                                            <?= ($required && !$hasImage) ? 'required' : '' ?>
                                            onchange="previewSingleImage(this, '<?= $previewId ?>', '<?= $iconId ?>')"
                                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-slate-700 file:text-white hover:file:bg-slate-800 cursor-pointer mb-2">
                                        
                                        <input type="hidden" name="old_<?= $key ?>" value="<?= htmlspecialchars(is_string($val) ? $val : '') ?>">
                                        
                                        <?php if($note): ?>
                                            <p class="text-xs text-slate-400 mt-1"><?= $note ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php break; ?>

                        <?php case 'password': ?>
                            <input type="password" name="<?= $key ?>" <?= $required ? 'required' : '' ?>
                                class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 transition-all"
                                placeholder="<?= $placeholder ?>">
                            <?php break; ?>

                        <?php default: ?>
                            <input type="<?= $type ?>" name="<?= $key ?>" value="<?= htmlspecialchars($val) ?>" 
                                <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?>
                                class="w-full px-4 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 transition-all placeholder-slate-400 disabled:bg-slate-100 disabled:text-slate-500"
                                placeholder="<?= $placeholder ?>">
                    <?php endswitch; ?>

                    <?php if ($type !== 'file' && $note): ?>
                        <p class="text-xs text-slate-400 mt-1.5"><?= $note ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
            <?php if(isset($form_back_link)): ?>
                <a href="<?= $form_back_link ?>" class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                    Hủy bỏ
                </a>
            <?php endif; ?>
            
            <button type="submit" class="px-8 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <?= $form_submit_label ?? 'Lưu dữ liệu' ?>
            </button>
        </div>

    </form>
</div>

<script>
    // 1. Preview ảnh đơn (Avatar, Banner)
    function previewSingleImage(input, imgId, iconId) {
        const imgEl = document.getElementById(imgId);
        const iconEl = document.getElementById(iconId);
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgEl.src = e.target.result;
                imgEl.classList.remove('hidden');
                if(iconEl) iconEl.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 2. Preview Gallery (Nhiều ảnh)
    function previewGallery(input, containerId) {
        const container = document.getElementById(containerId);
        // Xóa các preview "mới" cũ (nếu user chọn lại)
        const oldPreviews = container.querySelectorAll('.new-preview');
        oldPreviews.forEach(el => el.remove());

        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'new-preview relative aspect-square rounded-lg overflow-hidden border border-blue-200 bg-white shadow-sm';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute top-1 right-1 bg-blue-600 text-white text-[10px] px-1.5 py-0.5 rounded shadow">Mới</div>
                    `;
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>