<?php
// src/controllers/AdminTemplateController.php

require_once __DIR__ . '/../config.php';

class AdminTemplateController
{
    // 1. DANH SÁCH (List)
    public function index()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin/login');
            exit;
        }

        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;

        $model = new AdminTemplate();

        $totalRecords = $model->countAll($search);
        $templates = $model->getAll($limit, $offset, $search);
        $totalPages = ceil($totalRecords / $limit);
        $categories = $model->getCategories();

        $tabs = [
            ['id' => 'tab-list', 'label' => 'Templates', 'icon' => 'layout-grid'],
            ['id' => 'tab-category', 'label' => 'Danh mục', 'icon' => 'folder-tree']
        ];

        view('admin.template', [
            'title' => 'Quản lý Giao diện',
            'page_tabs' => $tabs,
            'templates' => $templates,
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'search' => $search
        ]);
    }

    // 2. FORM TẠO MỚI
    public function create()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin/login');
            exit;
        }

        $model = new AdminTemplate();
        $categories = $model->getCategories();

        view('admin.template-form', [
            'title' => 'Thêm Giao diện',
            'categories' => $categories
        ]);
    }

    // 3. XỬ LÝ LƯU (STORE)
    public function store()
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        $model = new AdminTemplate();
        $data = $_POST;

        if (empty($data['slug'])) $data['slug'] = $this->createSlug($data['name']);

        // 1. Upload 2 ảnh chính
        $data['image_desktop'] = !empty($_FILES['image_desktop']['name']) ? $this->uploadImage($_FILES['image_desktop']) : '';
        $data['image_mobile']  = !empty($_FILES['image_mobile']['name'])  ? $this->uploadImage($_FILES['image_mobile'])  : '';

        // 2. Tạo Template
        $newTemplateId = $model->create($data);
        
        // Log create action
        Logger::getInstance()->logCreate('TEMPLATE', $newTemplateId, ['name' => $data['name']]);

        // 3. Xử lý Upload Gallery (Nếu có)
        if ($newTemplateId && !empty($_FILES['gallery_files']['name'][0])) {
            $this->processGalleryUpload($newTemplateId, $_FILES['gallery_files']);
        }

        header('Location: /admin/template/edit/' . $newTemplateId);
    }

    // 4. FORM SỬA (EDIT)
    public function edit($id)
    { // Đổi tên hàm và tham số
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin/login');
            exit;
        }

        $model = new AdminTemplate();
        $template = $model->getById($id); // Dùng getById

        if (!$template) {
            echo "Không tìm thấy!";
            return;
        }

        $categories = $model->getCategories();
        $gallery = $model->getGallery($id); // Lấy gallery theo ID luôn cho chuẩn

        view('admin.template-form', [
            'title' => 'Cập nhật Template',
            'template' => $template,
            'categories' => $categories,
            'gallery' => $gallery
        ]);
    }

    // 5. XỬ LÝ CẬP NHẬT (UPDATE)
    public function update($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        $model = new AdminTemplate();
        $data = $_POST;

        if (empty($data['slug'])) $data['slug'] = $this->createSlug($data['name']);

        $rootPath = dirname(__DIR__); // Points to src/

        // 1. Xử lý 2 ảnh chính (Giữ nguyên logic cũ)
        $data['image_desktop'] = $_POST['old_image_desktop'] ?? '';
        if (!empty($_FILES['image_desktop']['name'])) {
            $path = $this->uploadImage($_FILES['image_desktop']);
            if ($path) {
                $oldPath = ltrim($data['image_desktop'], '/');
                $absOldPath = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $oldPath);
                if (!empty($oldPath) && file_exists($absOldPath) && !is_dir($absOldPath)) unlink($absOldPath);
                $data['image_desktop'] = $path;
            }
        }

        $data['image_mobile'] = $_POST['old_image_mobile'] ?? '';
        if (!empty($_FILES['image_mobile']['name'])) {
            $path = $this->uploadImage($_FILES['image_mobile']);
            if ($path) {
                $oldPath = ltrim($data['image_mobile'], '/');
                $absOldPath = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $oldPath);
                if (!empty($oldPath) && file_exists($absOldPath) && !is_dir($absOldPath)) unlink($absOldPath);
                $data['image_mobile'] = $path;
            }
        }

        // 2. Cập nhật Template
        $model->update($id, $data);
        
        // Log update action
        Logger::getInstance()->logUpdate('TEMPLATE', $id, ['name' => $data['name']]);

        // 3. Xử lý Upload Gallery (Upload thêm)
        if (!empty($_FILES['gallery_files']['name'][0])) {
            $this->processGalleryUpload($id, $_FILES['gallery_files']);
        }

        header('Location: /admin/template/edit/' . $id);
    }

    // --- HELPER: Xử lý loop upload gallery ---
    private function processGalleryUpload($templateId, $files)
    {
        $model = new AdminTemplate();
        $count = count($files['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $singleFile = [
                    'name' => $files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                ];
                $url = $this->uploadImage($singleFile);
                if ($url) $model->addGalleryImage($templateId, $url);
            }
        }
    }

    // 6. XỬ LÝ XÓA (DELETE)
    public function delete($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $model = new AdminTemplate();

        // --- XÓA FILE ẢNH TRÊN SERVER ---
        $rootPath = dirname(__DIR__); // Points to src/

        // 1. Lấy thông tin template để xóa 2 ảnh chính
        $tpl = $model->getById($id);
        if ($tpl) {
            $pathD = ltrim($tpl['image_desktop'], '/');
            $absD = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $pathD);
            if (file_exists($absD) && !is_dir($absD)) unlink($absD);

            $pathM = ltrim($tpl['image_mobile'], '/');
            $absM = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $pathM);
            if (file_exists($absM) && !is_dir($absM)) unlink($absM);
        }

        // 2. Lấy danh sách gallery để xóa ảnh phụ
        $gallery = $model->getGallery($id);
        foreach ($gallery as $img) {
            $pathG = ltrim($img['image_url'], '/');
            $absG = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $pathG);
            if (file_exists($absG) && !is_dir($absG)) unlink($absG);
        }

        // --- XÓA TRONG DATABASE ---
        $model->delete($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('TEMPLATE', $id, ['name' => $tpl['name'] ?? 'Unknown']);
        
        header('Location: /admin/template');
    }

    // 7. XỬ LÝ UPLOAD GALLERY (NHIỀU ẢNH)
    public function uploadGallery($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        if (!empty($_FILES['gallery_files']['name'][0])) {
            $model = new AdminTemplate();
            $files = $_FILES['gallery_files'];
            $count = count($files['name']);

            for ($i = 0; $i < $count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $singleFile = [
                        'name' => $files['name'][$i],
                        'type' => $files['type'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error' => $files['error'][$i],
                        'size' => $files['size'][$i]
                    ];

                    $url = $this->uploadImage($singleFile);
                    if ($url) {
                        $model->addGalleryImage($id, $url);
                        Logger::getInstance()->logUpload('TEMPLATE_GALLERY', basename($url), ['size' => $singleFile['size']]);
                    }
                }
            }
        }
        header('Location: /admin/template/edit/' . $id . '?tab=gallery');
        exit;
    }

    // 8. XÓA 1 ẢNH TRONG GALLERY
    public function deleteImage($imgId)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;

        // 1. Lấy thông tin ảnh để xóa file vật lý
        $stmt = Database::getConnection()->prepare("SELECT * FROM template_images WHERE id = :id");
        $stmt->execute([':id' => $imgId]);
        $img = $stmt->fetch();

        if ($img) {
            // Fix: Use absolute path for deletion
            $rootPath = dirname(__DIR__); // Points to src/
            $relativePath = ltrim($img['image_url'], '/');
            
            // Handle full URL if present (remove domain)
            $baseUrl = Config::getBaseUrl();
            if (strpos($relativePath, $baseUrl) === 0) {
                $relativePath = str_replace($baseUrl, '', $relativePath);
                $relativePath = ltrim($relativePath, '/');
            }

            $normalizedPath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $relativePath);
            $absolutePath = $rootPath . DIRECTORY_SEPARATOR . $normalizedPath;

            if (file_exists($absolutePath) && !is_dir($absolutePath)) {
                unlink($absolutePath);
            }

            // Xóa trong Database
            $stmtDel = Database::getConnection()->prepare("DELETE FROM template_images WHERE id = :id");
            $stmtDel->execute([':id' => $imgId]);
            
            // Log delete action
            Logger::getInstance()->logDelete('TEMPLATE_GALLERY_IMAGE', $imgId, ['url' => $img['image_url']]);
        }

        // Quay lại trang Edit
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // --- HELPER: UPLOAD FILE ---
    private function uploadImage($file)
    {
        // Validate file upload
        $validation = FileUploadValidator::validate($file, 'image');
        if (!$validation['valid']) {
            $_SESSION['upload_error'] = implode(', ', $validation['errors']);
            return '';
        }

        $rootPath = dirname(__DIR__); // Points to src/
        $targetDir = "uploads/templates/";
        $normalizedTarget = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($targetDir, '/'));
        $absoluteTargetDir = $rootPath . DIRECTORY_SEPARATOR . $normalizedTarget;

        if (!is_dir($absoluteTargetDir)) {
            if (!mkdir($absoluteTargetDir, 0777, true)) {
                 $error = error_get_last();
                 error_log("Failed to create directory: $absoluteTargetDir. Error: " . ($error['message'] ?? 'Unknown'));
                 return '';
            }
        }

        // Generate safe filename
        $safeFilename = FileUploadValidator::generateSafeFilename($file['name']);
        if (!$safeFilename) {
            $_SESSION['upload_error'] = 'Invalid file extension';
            return '';
        }

        $targetPath = $absoluteTargetDir . DIRECTORY_SEPARATOR . $safeFilename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            Logger::getInstance()->logUpload('TEMPLATE_IMAGE', $safeFilename, ['size' => $file['size']]);
            
            // Get base URL for production compatibility
            $baseUrl = Config::getBaseUrl();
            // Construct web path with forward slashes
            $webPath = '/' . str_replace('\\', '/', $normalizedTarget) . '/' . $safeFilename;
            return $baseUrl . $webPath;
        }
        return '';
    }

    // --- HELPER: TẠO SLUG ---
    private function createSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}
