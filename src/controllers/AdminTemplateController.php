<?php
// src/controllers/AdminTemplateController.php

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
        $model = new AdminTemplate();
        $data = $_POST;

        if (empty($data['slug'])) $data['slug'] = $this->createSlug($data['name']);

        // 1. Upload 2 ảnh chính
        $data['image_desktop'] = !empty($_FILES['image_desktop']['name']) ? $this->uploadImage($_FILES['image_desktop']) : '';
        $data['image_mobile']  = !empty($_FILES['image_mobile']['name'])  ? $this->uploadImage($_FILES['image_mobile'])  : '';

        // 2. Tạo Template
        // Lưu ý: Hàm create() của Model cần trả về ID vừa tạo để ta upload gallery cho nó
        // Bạn cần sửa model: return $this->conn->lastInsertId();
        $model->create($data);
        $newTemplateId = $model->getLastId(); // Giả sử bạn viết thêm hàm lấy ID mới nhất hoặc sửa hàm create trả về ID

        // 3. Xử lý Upload Gallery (Nếu có)
        if ($newTemplateId && !empty($_FILES['gallery_files']['name'][0])) {
            $this->processGalleryUpload($newTemplateId, $_FILES['gallery_files']);
        }

        header('Location: /admin/template');
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
        $model = new AdminTemplate();
        $data = $_POST;

        if (empty($data['slug'])) $data['slug'] = $this->createSlug($data['name']);

        // 1. Xử lý 2 ảnh chính (Giữ nguyên logic cũ)
        $data['image_desktop'] = $_POST['old_image_desktop'] ?? '';
        if (!empty($_FILES['image_desktop']['name'])) {
            $path = $this->uploadImage($_FILES['image_desktop']);
            if ($path) {
                if (file_exists(ltrim($data['image_desktop'], '/'))) unlink(ltrim($data['image_desktop'], '/'));
                $data['image_desktop'] = $path;
            }
        }

        $data['image_mobile'] = $_POST['old_image_mobile'] ?? '';
        if (!empty($_FILES['image_mobile']['name'])) {
            $path = $this->uploadImage($_FILES['image_mobile']);
            if ($path) {
                if (file_exists(ltrim($data['image_mobile'], '/'))) unlink(ltrim($data['image_mobile'], '/'));
                $data['image_mobile'] = $path;
            }
        }

        // 2. Cập nhật Template
        $model->update($id, $data);

        // 3. Xử lý Upload Gallery (Upload thêm)
        if (!empty($_FILES['gallery_files']['name'][0])) {
            $this->processGalleryUpload($id, $_FILES['gallery_files']);
        }

        header('Location: /admin/template');
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
        // 1. Lấy thông tin template để xóa 2 ảnh chính
        $tpl = $model->getById($id);
        if ($tpl) {
            $pathD = ltrim($tpl['image_desktop'], '/');
            if (file_exists($pathD) && !is_dir($pathD)) unlink($pathD);

            $pathM = ltrim($tpl['image_mobile'], '/');
            if (file_exists($pathM) && !is_dir($pathM)) unlink($pathM);
        }

        // 2. Lấy danh sách gallery để xóa ảnh phụ
        $gallery = $model->getGallery($id);
        foreach ($gallery as $img) {
            $pathG = ltrim($img['image_url'], '/');
            if (file_exists($pathG) && !is_dir($pathG)) unlink($pathG);
        }

        // --- XÓA TRONG DATABASE ---
        $model->delete($id);
        header('Location: /admin/template');
    }

    // 7. XỬ LÝ UPLOAD GALLERY (NHIỀU ẢNH)
    public function uploadGallery($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;

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

        $model = new AdminTemplate();

        // 1. Lấy thông tin ảnh để xóa file vật lý
        // (Cần viết thêm hàm getGalleryImageById trong Model nếu chưa có, hoặc truy vấn trực tiếp)
        // Ở đây giả định Model có hàm này hoặc ta query nhanh
        $stmt = Database::getConnection()->prepare("SELECT * FROM template_images WHERE id = :id");
        $stmt->execute([':id' => $imgId]);
        $img = $stmt->fetch();

        if ($img) {
            // Xóa file trong thư mục uploads
            $filePath = ltrim($img['image_url'], '/');
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Xóa trong Database
            $stmtDel = Database::getConnection()->prepare("DELETE FROM template_images WHERE id = :id");
            $stmtDel->execute([':id' => $imgId]);
        }

        // Quay lại trang Edit
        // $_SERVER['HTTP_REFERER'] sẽ đưa user về lại đúng cái form đang sửa
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // --- HELPER: UPLOAD FILE ---
    private function uploadImage($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return '';

        $targetDir = "uploads/templates/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

        // Đổi tên file: time_random.ext
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = time() . '_' . rand(1000, 9999) . '.' . $extension;
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return '/' . $targetPath;
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
