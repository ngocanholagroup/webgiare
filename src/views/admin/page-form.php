<?php include 'includes/admin-header.php'; ?>

<?php
// Định nghĩa các class CSS chuẩn của hệ thống để tái sử dụng
// Giúp giao diện đồng bộ 100% với includes/form.php
$labelClass = "block text-xs font-semibold text-slate-500 mb-1.5 uppercase tracking-wide";
$inputClass = "w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all placeholder-slate-400 disabled:bg-slate-100 disabled:text-slate-500";
$cardClass  = "bg-white p-6 rounded-xl border border-slate-200 shadow-sm";
?>

<form action="/admin/page/update/<?= $page['id'] ?>" method="POST" class="max-w-6xl mx-auto pb-20">
    
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="/admin/page" class="text-slate-500 hover:text-slate-800 text-sm flex items-center gap-1 mb-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Quay lại danh sách
            </a>
            <h1 class="text-xl font-bold text-slate-800">Thiết kế nội dung: <?= htmlspecialchars($page['name']) ?></h1>
        </div>
        
        <button type="submit" class="bg-slate-800 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-orange-600 transition-all shadow-lg shadow-slate-300 inline-flex items-center gap-2">
            <i data-lucide="save" class="w-4 h-4"></i> Lưu thay đổi
        </button>
    </div>

    <div class="grid grid-cols-12 gap-6">
        
        <div class="col-span-12 lg:col-span-4 space-y-6">
            
            <div class="<?= $cardClass ?>">
                <h3 class="font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="settings" class="w-4 h-4 text-slate-400"></i> Cấu hình chung
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="<?= $labelClass ?>">Tên trang (Admin)</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($page['name']) ?>" class="<?= $inputClass ?>">
                    </div>
                    
                    <div>
                        <label class="<?= $labelClass ?>">Đường dẫn (Slug)</label>
                        <input type="text" value="/<?= htmlspecialchars($page['slug']) ?>" disabled class="<?= $inputClass ?> font-mono text-blue-600 bg-blue-50 border-blue-200">
                    </div>
                </div>
            </div>

            <div class="<?= $cardClass ?>">
                <h3 class="font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400"></i> Tối ưu SEO
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="<?= $labelClass ?>">Meta Title (Tiêu đề tìm kiếm)</label>
                        <input type="text" name="meta_title" value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>" class="<?= $inputClass ?>" placeholder="Tiêu đề hiển thị trên Google...">
                    </div>
                    
                    <div>
                        <label class="<?= $labelClass ?>">Meta Description (Mô tả)</label>
                        <textarea name="meta_desc" rows="4" class="<?= $inputClass ?>" placeholder="Mô tả ngắn gọn nội dung trang..."><?= htmlspecialchars($page['meta_desc'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl text-xs text-blue-800 leading-relaxed">
                <p class="font-bold mb-1 flex items-center gap-1"><i data-lucide="info" class="w-3 h-3"></i> Lưu ý kỹ thuật:</p>
                <p>Nội dung bên phải được sinh tự động từ cấu trúc JSON. Bạn có thể chỉnh sửa văn bản, link ảnh, màu sắc tùy theo cấu trúc đã định nghĩa.</p>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8">
            <div class="space-y-6">
                
                <?php 
                // Hàm đệ quy render form - Sử dụng đúng class CSS của hệ thống
                function renderJsonForm($data, $prefix = 'content', $depth = 0) {
                    global $labelClass, $inputClass; // Gọi biến toàn cục

                    foreach ($data as $key => $value) {
                        $inputName = $prefix . '[' . $key . ']';
                        $label = ucwords(str_replace('_', ' ', $key)); // Làm đẹp label (feature_items -> Feature Items)

                        // 1. Nếu là MẢNG (Nhóm con) -> Render Box/Card
                        if (is_array($value)) {
                            // Màu viền thay đổi theo độ sâu để dễ nhìn
                            $borderColor = ($depth == 0) ? 'border-orange-500' : 'border-slate-200';
                            $bgColor = ($depth % 2 == 0) ? 'bg-white' : 'bg-slate-50/50';
                            
                            echo '<div class="'.$bgColor.' p-5 rounded-xl border '.$borderColor.' shadow-sm relative">';
                            
                            // Tiêu đề nhóm
                            echo '<h3 class="font-bold text-slate-700 border-b border-slate-200 pb-2 mb-4 uppercase text-xs tracking-wider flex items-center gap-2">';
                            if ($depth == 0) echo '<i data-lucide="layers" class="w-4 h-4 text-orange-500"></i> '; // Icon cho cấp 1
                            echo $label;
                            echo '</h3>';
                            
                            echo '<div class="space-y-4 pl-1">';
                            renderJsonForm($value, $inputName, $depth + 1); // Gọi đệ quy
                            echo '</div>';
                            echo '</div>';
                        } 
                        
                        // 2. Nếu là CHUỖI (Input) -> Render Input
                        else {
                            echo '<div class="relative group">';
                            echo '<label class="'.$labelClass.' text-[11px] mb-1">' . $label . '</label>';
                            
                            // Phát hiện key để chọn loại input phù hợp
                            
                            // Trường hợp: Hình ảnh (Key chứa 'image', 'thumb', 'icon', 'bg')
                            if (preg_match('/(image|img|thumb|icon|bg|avatar)/i', $key)) {
                                echo '<div class="flex gap-2">';
                                echo '<input type="text" name="'.$inputName.'" value="'.htmlspecialchars($value).'" class="'.$inputClass.' font-mono text-blue-600 bg-slate-50">';
                                // Có thể thêm nút upload ở đây nếu muốn nâng cao sau này
                                echo '</div>';
                            }
                            // Trường hợp: Văn bản dài (> 50 ký tự hoặc key chứa 'desc', 'content')
                            elseif (strlen($value) > 60 || preg_match('/(desc|content|intro|bio)/i', $key)) {
                                echo '<textarea name="'.$inputName.'" rows="3" class="'.$inputClass.'">'.htmlspecialchars($value).'</textarea>';
                            }
                            // Trường hợp: Màu sắc (Key chứa 'color')
                            elseif (preg_match('/(color)/i', $key)) {
                                echo '<div class="flex items-center gap-2">';
                                echo '<input type="color" value="'.htmlspecialchars($value).'" class="h-9 w-9 p-1 rounded border border-slate-300 cursor-pointer" onchange="this.nextElementSibling.value = this.value">';
                                echo '<input type="text" name="'.$inputName.'" value="'.htmlspecialchars($value).'" class="'.$inputClass.' uppercase font-mono">';
                                echo '</div>';
                            }
                            // Trường hợp: Mặc định (Input Text)
                            else {
                                echo '<input type="text" name="'.$inputName.'" value="'.htmlspecialchars($value).'" class="'.$inputClass.'">';
                            }
                            
                            // Hiển thị key gốc khi hover để dev dễ debug
                            echo '<span class="absolute top-0 right-0 text-[9px] text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity font-mono">key: '.$key.'</span>';
                            echo '</div>';
                        }
                    }
                }

                // Chạy hàm render
                if (!empty($content)) {
                    renderJsonForm($content);
                } else {
                    echo '<div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-300 text-slate-400">';
                    echo '<i data-lucide="code" class="w-8 h-8 mx-auto mb-2 opacity-50"></i>';
                    echo 'Chưa có dữ liệu JSON mẫu.';
                    echo '</div>';
                }
                ?>
                
            </div>
        </div>

    </div>
</form>

<?php include 'includes/admin-footer.php'; ?>