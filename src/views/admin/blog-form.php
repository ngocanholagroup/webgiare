<?php include 'includes/admin-header.php'; ?>

<?php
$isEdit = isset($post);
$data = $post ?? [];

// Convert options
$catOpts = []; foreach($categories as $c) $catOpts[$c['id']] = $c['name'];
$authOpts = []; foreach($authors as $a) $authOpts[$a['id']] = $a['name'];

$form_fields = [
    [
        'label' => 'Tiêu đề bài viết', 'name' => 'title', 'required' => true, 
        'width' => 'col-span-12 md:col-span-8', 'placeholder' => 'Nhập tiêu đề...'
    ],
    [
        'label' => 'Danh mục', 'name' => 'category_id', 'type' => 'select', 'required' => true,
        'width' => 'col-span-12 md:col-span-4', 'options' => $catOpts
    ],
    // --- Hàng 2 ---
    [
        'label' => 'Ảnh đại diện (Thumbnail)', 'name' => 'thumbnail', 'type' => 'file',
        'width' => 'col-span-12 md:col-span-6', 'required' => true, 'note' => 'Kích thước 800x600px'
    ],
    [
        'label' => 'Slug (URL)', 'name' => 'slug', 
        'width' => 'col-span-12 md:col-span-6', 'placeholder' => 'tu-dong-tao'
    ],
    // --- Hàng 3 ---
    [
        'label' => 'Mô tả ngắn (Summary)', 'name' => 'summary', 'type' => 'textarea', 'rows' => 3,
        'width' => 'col-span-12', 'placeholder' => 'Hiện ở card bài viết...'
    ],
// --- Hàng 4: Nội dung chính ---
    [
        'label' => 'Nội dung chi tiết', 
        'name' => 'content', 
        'type' => 'textarea', 
        'rows' => 20,
        'width' => 'col-span-12', 
        'required' => false,
        'class' => 'tinymce-editor',
        'id' => 'content-editor'
    ],
    // --- Hàng 5: Cấu hình ---
    [
        'label' => 'Tác giả', 'name' => 'author_id', 'type' => 'select', 
        'width' => 'col-span-6 md:col-span-3', 'options' => $authOpts
    ],
    [
        'label' => 'Thời gian đọc (phút)', 'name' => 'reading_time', 'type' => 'number',
        'width' => 'col-span-6 md:col-span-3', 'placeholder' => '5', 'min' => '1', 'max' => '999'
    ],
    [
        'label' => 'Nổi bật', 'name' => 'is_featured', 'type' => 'select',
        'width' => 'col-span-6 md:col-span-3', 'options' => ['0' => 'Không', '1' => 'Có']
    ],
    [
        'label' => 'Trạng thái', 'name' => 'status', 'type' => 'select',
        'width' => 'col-span-6 md:col-span-3', 'options' => ['1' => 'Xuất bản', '0' => 'Nháp']
    ]
];

$form_title = $title;
$form_action = $isEdit ? "/admin/blog/update/{$post['id']}" : "/admin/blog/store";
$form_back_link = '/admin/blog';
$form_data = $data;

include 'includes/form.php';
?>

<!-- Fixed Save Button -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 shadow-lg z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="text-sm text-slate-500">
                <span id="save-status" class="hidden">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Đang lưu...
                </span>
                <span id="save-success" class="hidden text-green-600">
                    <i class="fas fa-check mr-2"></i>Đã lưu!
                </span>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="window.location.href='<?= $form_back_link ?>'" 
                        class="px-6 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">
                    <i class="fas fa-times mr-2"></i>Hủy bỏ
                </button>
                <button type="submit" form="main-form" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm">
                    <i class="fas fa-save mr-2"></i>Lưu bài viết
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add padding bottom to avoid content being hidden by fixed button -->
<style>
body {
    padding-bottom: 80px;
}
</style>

<!-- JavaScript for form handling -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('main-form');
    const saveStatus = document.getElementById('save-status');
    const saveSuccess = document.getElementById('save-success');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            // Show saving status
            saveStatus.classList.remove('hidden');
            saveSuccess.classList.add('hidden');
            
            // Hide saving status after 3 seconds (in case of slow response)
            setTimeout(() => {
                saveStatus.classList.add('hidden');
            }, 3000);
        });
    }
    
    // Show success message when page loads with success parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        saveSuccess.classList.remove('hidden');
        setTimeout(() => {
            saveSuccess.classList.add('hidden');
        }, 3000);
    }
});
</script>

<?php include 'includes/admin-footer.php'; ?>

<!-- TinyMCE Editor - Stable Version -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing TinyMCE...');
    
    // Kiểm tra xem TinyMCE có được load không
    if (typeof tinymce === 'undefined') {
        console.error('TinyMCE not loaded!');
        return;
    }
    
    console.log('TinyMCE loaded:', tinymce);
    
    // Khởi tạo TinyMCE cho tất cả textarea có class 'tinymce-editor'
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        
        // Cấu hình cơ bản
        height: 600,
        menubar: true,
        language: 'en',
        
        // Theme và skin
        skin: 'oxide',
        content_css: 'default',
        
        // License key cho open source
        license_key: 'gpl',
        
        // Plugins - Reduced set to avoid errors
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        
        // Toolbar - Simplified
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | ' +
                'forecolor backcolor removeformat | ' +
                'link image media table | ' +
                'fullscreen preview print help',
        
        // Menu bar - Simplified
        menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
            view: { title: 'View', items: 'code | visualaid visualchars visualblocks | preview fullscreen' },
            insert: { title: 'Insert', items: 'image link media template inserttable | charmap hr | pagebreak nonbreaking anchor toc | insertdatetime' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats | fontfamily fontsize | align lineheight | forecolor backcolor | removeformat' },
            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
            table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
            help: { title: 'Help', items: 'help' }
        },
        
        // Style formats
        style_formats: [
            { title: 'Heading 1', format: 'h1' },
            { title: 'Heading 2', format: 'h2' },
            { title: 'Heading 3', format: 'h3' },
            { title: 'Paragraph', format: 'p' },
            { title: 'Quote', format: 'blockquote' },
            { title: 'Code', format: 'code' }
        ],
        
        // Font sizes
        fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 28pt 32pt 36pt 48pt 60pt 72pt',
        
        // Font families
        font_family_formats: 'Arial=arial,helvetica,sans-serif; ' +
            'Calibri=calibri,arial,sans-serif; ' +
            'Times New Roman=times new roman,times,serif; ' +
            'Verdana=verdana,geneva,sans-serif; ' +
            'Courier New=courier new,courier,monospace',
        
        // Content style
        content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; }' +
            'h1 { font-size: 2em; font-weight: bold; margin: 0.67em 0; }' +
            'h2 { font-size: 1.5em; font-weight: bold; margin: 0.75em 0; }' +
            'h3 { font-size: 1.17em; font-weight: bold; margin: 0.83em 0; }' +
            'blockquote { border-left: 4px solid #ccc; padding-left: 1em; margin: 1em 0; color: #666; }' +
            'code { background: #f4f4f4; padding: 2px 4px; border-radius: 3px; font-family: monospace; }' +
            'pre { background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto; }',
        
        // Image upload - Simplified for TinyMCE 6+
        images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
            console.log('Starting image upload...', blobInfo.filename());
            
            var formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/admin/upload-tinymce');
            xhr.withCredentials = false;
            
            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };
            
            xhr.onload = function() {
                console.log('Upload response status:', xhr.status);
                console.log('Upload response text:', xhr.responseText);
                
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        console.log('Parsed response:', response);
                        
                        if (response && typeof response === 'object' && 'location' in response) {
                            console.log('Upload successful! URL:', response.location);
                            resolve(response.location);
                        } else {
                            console.error('Invalid response format:', response);
                            reject('Server response missing location URL');
                        }
                    } catch (e) {
                        console.error('JSON parse error:', e);
                        reject('Failed to parse server response');
                    }
                } else {
                    console.error('Server error:', xhr.status, xhr.responseText);
                    reject('Server error: ' + xhr.status);
                }
            };
            
            xhr.onerror = function() {
                console.error('Network error during upload');
                reject('Network error: Failed to upload image');
            };
            
            xhr.send(formData);
        }),
        
        // Other settings
        branding: false,
        promotion: false,
        statusbar: true,
        elementpath: true,
        
        // Auto-save
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        
        // Paste settings
        paste_data_images: true,
        paste_as_text: false,
        paste_merge_formats: true,
        paste_auto_cleanup_on_paste: true,
        paste_remove_spans: true,
        paste_remove_styles: false,
        paste_retain_style_properties: 'color,font-size,font-family,background-color,background',
        
        // Table settings
        table_default_attributes: {
            'border': '1'
        },
        table_default_styles: {
            'border-collapse': 'collapse',
            'width': '100%'
        },
        
        // Setup callback
        setup: function(editor) {
            console.log('Setting up editor:', editor);
            
            // Đảm bảo textarea không bị disabled
            var textarea = editor.targetElm;
            if (textarea) {
                textarea.removeAttribute('readonly');
                textarea.removeAttribute('disabled');
            }
            
            // Custom commands
            editor.ui.registry.addButton('customSave', {
                text: 'Lưu bài viết',
                tooltip: 'Lưu bài viết',
                onAction: function() {
                    document.querySelector('form').submit();
                }
            });
            
            // Add save button to toolbar
            editor.ui.registry.addMenuItem('customSave', {
                text: 'Lưu bài viết',
                icon: 'save',
                onAction: function() {
                    document.querySelector('form').submit();
                }
            });
        },
        
        // Initialize callback
        init_instance_callback: function(editor) {
            console.log('TinyMCE editor initialized successfully!');
        }
    });
});
</script>

<style>
/* Custom styles for TinyMCE */
.tox-tinymce {
    border-radius: 8px !important;
    border: 1px solid #d1d5db !important;
    min-height: 800px !important;
}

.tox-toolbar__group {
    border-right: 1px solid #e5e7eb !important;
}

.tox-toolbar__group:last-child {
    border-right: none !important;
}

.tox-statusbar {
    border-top: 1px solid #e5e7eb !important;
}

/* Editor content area - tăng font size và line height */
.tox-edit-area iframe {
    font-size: 16px !important;
    line-height: 1.8 !important;
    padding: 20px !important;
}

/* Toolbar - làm lớn hơn */
.tox-toolbar {
    padding: 8px !important;
}

.tox-toolbar .tox-toolbar__group {
    padding: 0 8px !important;
}

.tox-toolbar .tox-tbtn {
    height: 36px !important;
    padding: 0 12px !important;
    font-size: 14px !important;
}

/* Menu bar */
.tox-menubar {
    background: #f8f9fa !important;
    border-bottom: 1px solid #e5e7eb !important;
    padding: 8px 16px !important;
}

.tox-mbtn {
    height: 32px !important;
    padding: 0 12px !important;
    font-size: 13px !important;
}

/* Content styles */
.tox-edit-area {
    font-family: 'Segoe UI', Arial, sans-serif !important;
}

/* Form styling */
.form-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Status bar */
.tox-statusbar {
    font-size: 12px !important;
    padding: 8px 16px !important;
}

/* Path indicator */
.tox-statusbar__path {
    font-size: 12px !important;
}

/* Word count */
.tox-statusbar__wordcount {
    font-size: 12px !important;
}
</style>