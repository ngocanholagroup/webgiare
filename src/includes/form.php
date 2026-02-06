<?php
/**
 * COMPONENT: DYNAMIC FORM V3 (Multi-File Upload Support)
 */

// Kiểm tra xem có input file không để thêm enctype
$hasFile = false;
foreach ($form_fields as $f) { if (($f['type'] ?? '') === 'file') $hasFile = true; }
?>

<div class="max-w-4xl mx-auto">
    <div class="mb-6 border-b border-slate-200 pb-4">
        <h1 class="text-xl font-bold text-slate-800"><?= $form_title ?? 'Form dữ liệu' ?></h1>
    </div>

    <form action="<?= $form_action ?>" method="POST" <?= $hasFile ? 'enctype="multipart/form-data"' : '' ?> 
          class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        
        <div class="grid grid-cols-12 gap-6">
            <?php foreach ($form_fields as $field): 
                $key = $field['name'];
                $val = $form_data[$key] ?? '';
                $type = $field['type'] ?? 'text';
                $width = $field['width'] ?? 'col-span-12'; 
                $required = $field['required'] ?? false;
                $disabled = $field['disabled'] ?? false;
                $isMultiple = $field['multiple'] ?? false; // Check multiple
            ?>
                <div class="<?= $width ?>">
                    
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide">
                        <?= $field['label'] ?>
                        <?php if($required): ?> <span class="text-red-500">*</span> <?php endif; ?>
                    </label>

                    <?php switch ($type): 
                        case 'textarea': ?>
                            <textarea name="<?= $key ?>" rows="<?= $field['rows'] ?? 4 ?>" <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?>
                                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all placeholder-slate-400"
                                placeholder="<?= $field['placeholder'] ?? '' ?>"><?= htmlspecialchars($val) ?></textarea>
                            <?php break; ?>

                        <?php case 'select': ?>
                            <select name="<?= $key ?>" <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?>
                                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500 bg-white cursor-pointer">
                                <?php foreach ($field['options'] as $optVal => $optLabel): ?>
                                    <option value="<?= $optVal ?>" <?= (string)$val === (string)$optVal ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($optLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php break; ?>

                        <?php case 'file': 
                            // --- LOGIC UPLOAD ---
                            $inputId = "input_" . $key;
                            
                            if ($isMultiple): 
                                // === TRƯỜNG HỢP UPLOAD NHIỀU ẢNH (GALLERY) === 
                                $previewContainerId = "gallery_preview_" . $key;
                                ?>
                                <div class="border border-dashed border-slate-300 rounded-xl p-4 bg-slate-50/50">
                                    <div class="mb-4">
                                        <input type="file" name="<?= $key ?>[]" id="<?= $inputId ?>" multiple accept="image/*"
                                            onchange="previewGallery(this, '<?= $previewContainerId ?>')"
                                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                                        <p class="text-[10px] text-slate-400 mt-2">Giữ <strong>Ctrl</strong> để chọn nhiều ảnh.</p>
                                    </div>

                                    <div class="grid grid-cols-4 gap-4" id="<?= $previewContainerId ?>">
                                        <?php if (!empty($val) && is_array($val)): foreach($val as $imgUrl): ?>
                                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-slate-200">
                                                <img src="<?= htmlspecialchars($imgUrl) ?>" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs">
                                                    Ảnh cũ
                                                </div>
                                            </div>
                                        <?php endforeach; endif; ?>
                                        
                                        </div>
                                </div>

                            <?php else: 
                                // === TRƯỜNG HỢP UPLOAD 1 ẢNH (AVATAR/BANNER) === 
                                $previewId = "preview_" . $key;
                                $iconId = "icon_" . $key;
                                $hasImage = !empty($val) && is_string($val); 
                                ?>
                                <div class="flex items-start gap-4 p-3 border border-slate-200 rounded-xl bg-slate-50/50">
                                    <div class="shrink-0 w-24 h-24 bg-white border border-slate-300 rounded-lg overflow-hidden flex items-center justify-center relative shadow-sm">
                                        <img id="<?= $previewId ?>" src="<?= $hasImage ? htmlspecialchars($val) : '' ?>" 
                                             class="w-full h-full object-cover <?= $hasImage ? '' : 'hidden' ?>">
                                        <i id="<?= $iconId ?>" data-lucide="image" 
                                           class="w-8 h-8 text-slate-300 <?= $hasImage ? 'hidden' : '' ?>"></i>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <input type="file" name="<?= $key ?>" id="<?= $inputId ?>" accept="image/*"
                                               <?= ($required && !$hasImage) ? 'required' : '' ?>
                                               onchange="previewImage(this, '<?= $previewId ?>', '<?= $iconId ?>')"
                                               class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer mb-2">
                                        
                                        <p class="text-[10px] text-slate-400">
                                            <?= $field['note'] ?? 'Hỗ trợ: JPG, PNG. Max: 5MB.' ?>
                                        </p>
                                        <input type="hidden" name="old_<?= $key ?>" value="<?= htmlspecialchars(is_string($val) ? $val : '') ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php break; ?>
                        
                        <?php case 'password': ?>
                            <input type="password" name="<?= $key ?>" <?= $required ? 'required' : '' ?>
                                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500 transition-all bg-orange-50/30"
                                placeholder="<?= $field['placeholder'] ?? '••••••••' ?>">
                            <?php break; ?>

                        <?php default: ?>
                            <input type="<?= $type ?>" name="<?= $key ?>" value="<?= htmlspecialchars($val) ?>" <?= $required ? 'required' : '' ?> <?= $disabled ? 'disabled' : '' ?>
                                class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500 transition-all placeholder-slate-400 disabled:bg-slate-100 disabled:text-slate-500"
                                placeholder="<?= $field['placeholder'] ?? '' ?>">
                            <?php break; ?>

                    <?php endswitch; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-8 pt-4 border-t border-slate-100 text-right">
            <button type="submit" class="bg-slate-800 text-white px-8 py-2.5 rounded-lg text-sm font-bold hover:bg-orange-600 transition-all shadow-lg shadow-slate-300 inline-flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <?= $form_submit_label ?? 'Lưu dữ liệu' ?>
            </button>
        </div>

    </form>
</div>

<script>
// Preview 1 Ảnh
function previewImage(input, imgId, iconId) {
    const imgEl = document.getElementById(imgId);
    const iconEl = document.getElementById(iconId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imgEl.src = e.target.result;
            imgEl.classList.remove('hidden');
            iconEl.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Preview Nhiều Ảnh (Gallery)
function previewGallery(input, containerId) {
    const container = document.getElementById(containerId);
    
    // Lưu ý: Không xóa ảnh cũ (từ server) đã render bằng PHP
    // Chỉ xóa các ảnh preview "mới" (nếu user chọn đi chọn lại)
    const oldPreviews = container.querySelectorAll('.new-preview');
    oldPreviews.forEach(el => el.remove());

    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Tạo thẻ div chứa ảnh
                const div = document.createElement('div');
                div.className = 'new-preview relative aspect-square rounded-lg overflow-hidden border border-blue-200';
                
                // Tạo ảnh
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                // Badge "Mới"
                const badge = document.createElement('div');
                badge.className = 'absolute top-1 right-1 bg-blue-600 text-white text-[10px] px-1.5 py-0.5 rounded shadow';
                badge.innerText = 'New';

                div.appendChild(img);
                div.appendChild(badge);
                container.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>