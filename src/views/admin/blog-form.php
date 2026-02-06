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
        'rows' => 15,
        'width' => 'col-span-12', 
        'required' => false // <--- [QUAN TRỌNG] Đổi true thành false để tránh lỗi "not focusable"
    ],
    // --- Hàng 5: Cấu hình ---
    [
        'label' => 'Tác giả', 'name' => 'author_id', 'type' => 'select', 
        'width' => 'col-span-6 md:col-span-3', 'options' => $authOpts
    ],
    [
        'label' => 'Thời gian đọc (phút)', 'name' => 'reading_time', 'type' => 'text',
        'width' => 'col-span-6 md:col-span-3', 'placeholder' => '5'
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

<?php include 'includes/admin-footer.php'; ?>

<style>
    .ck-editor__editable_inline {
        min-height: 400px;
        max-height: 600px;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<script>
    // 1. Định nghĩa Custom Upload Adapter (Giữ nguyên như cũ)
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }
        abort() {
            if (this.xhr) this.xhr.abort();
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open('POST', '/admin/upload-ckeditor', true);
            xhr.responseType = 'json';
        }
        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Không thể upload file: ${file.name}.`;

            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }
                resolve({ default: response.url });
            });
        }
        _sendRequest(file) {
            const data = new FormData();
            data.append('upload', file);
            this.xhr.send(data);
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    // 2. Khởi tạo Editor & Xử lý Submit Form
    document.addEventListener("DOMContentLoaded", function() {
        const textarea = document.querySelector('textarea[name="content"]');

        if (textarea) {
            ClassicEditor
                .create(textarea, {
                    // Plugin Upload ảnh Custom (Giữ nguyên đoạn code cũ của bạn ở trên)
                    extraPlugins: [MyCustomUploadAdapterPlugin],
                    
                    // --- [CẬP NHẬT 1] THÊM NÚT CODE VÀO TOOLBAR ---
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'code', '|', // Thêm 'code' (Inline)
                            'link', 'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                        ]
                    },

                    // --- [CẬP NHẬT 2] THÊM TÙY CHỌN "CODE BLOCK" VÀO MENU HEADING ---
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Đoạn văn (P)', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h2', title: 'Tiêu đề lớn (H2)', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h3', title: 'Tiêu đề nhỏ (H3)', class: 'ck-heading_heading2' },
                            
                            // Thêm dòng này để tạo Code Block (Thẻ <pre>)
                            { model: 'formatted', view: 'pre', title: 'Khối Code (Pre)', class: 'ck-heading_formatted' }
                        ]
                    }
                })
                .then(editor => {
                    console.log('CKEditor đã sẵn sàng!');
                    
                    // (Giữ nguyên đoạn code fix lỗi Submit Form cũ của bạn)
                    const form = textarea.closest('form');
                    if (form) {
                        form.addEventListener('submit', (e) => {
                            const editorData = editor.getData();
                            textarea.value = editorData;
                        });
                    }
                })
                .catch(error => {
                    console.error('Lỗi khởi động CKEditor:', error);
                });
        }
    });
</script>