<?php
// src/controllers/AdminContactController.php

class AdminContactController {
    
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }

        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Giảm limit xuống chút vì load nhiều bảng
        $offset = ($page - 1) * $limit;

        $model = new AdminContact();
        
        // 1. Dữ liệu Tab Dịch vụ
        $serviceList = $model->getServiceTypes();

        // 2. Dữ liệu 4 Tab Trạng thái
        // Helper function để đỡ viết lại code (Closure)
        $fetchByStatus = function($status) use ($model, $limit, $offset, $search) {
            return [
                'data' => $model->getAll($limit, $offset, $search, $status),
                'total' => $model->countAll($search, $status),
                'status' => $status
            ];
        };

        $dataNew       = $fetchByStatus('new');
        $dataContacted = $fetchByStatus('contacted');
        $dataCompleted = $fetchByStatus('completed');
        $dataSpam      = $fetchByStatus('spam');

        // 3. Định nghĩa 5 Tabs
        $tabs = [
            ['id' => 'tab-new',       'label' => 'Mới gửi (' . $dataNew['total'] . ')',       'icon' => 'inbox'],
            ['id' => 'tab-contacted', 'label' => 'Đã liên hệ (' . $dataContacted['total'] . ')', 'icon' => 'phone-outgoing'],
            ['id' => 'tab-completed', 'label' => 'Hoàn thành (' . $dataCompleted['total'] . ')',  'icon' => 'check-circle'],
            ['id' => 'tab-spam',      'label' => 'Spam (' . $dataSpam['total'] . ')',         'icon' => 'trash-2'],
            ['id' => 'tab-services',  'label' => 'Quản lý Dịch vụ',                           'icon' => 'list']
        ];

        view('admin.contact', [
            'title' => 'Quản lý Liên hệ',
            'page_tabs' => $tabs,
            
            // Truyền dữ liệu xuống view
            'groupData' => [
                'new'       => $dataNew,
                'contacted' => $dataContacted,
                'completed' => $dataCompleted,
                'spam'      => $dataSpam
            ],
            'serviceList' => $serviceList,
            
            // Pagination chung (Dùng chung page cho tất cả tab)
            'currentPage' => $page,
            'limit'       => $limit,
            'search'      => $search
        ]);
    }

    // --- ACTIONS CHO DỊCH VỤ ---
    
    public function storeService() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        if (!empty($_POST['name'])) {
            $model = new AdminContact();
            $model->addService($_POST['name']);
        }
        header('Location: /admin/contact'); // Quay lại trang Contact
    }

    public function deleteService($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $model = new AdminContact();
        $model->deleteService($id);
        header('Location: /admin/contact');
    }

    // Trang xem chi tiết & Cập nhật trạng thái
    public function detail($id) {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        $model = new AdminContact();
        $contact = $model->getById($id);

        if (!$contact) { echo "Không tìm thấy liên hệ"; return; }

        view('admin.contact-detail', [
            'title' => 'Chi tiết liên hệ #' . $id,
            'contact' => $contact
        ]);
    }

    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $model = new AdminContact();
        $data = [
            'status' => $_POST['status'],
            'admin_note' => $_POST['admin_note']
        ];
        
        $model->update($id, $data);
        
        // Quay lại trang danh sách đúng tab đó
        $tabMap = ['new' => 'new', 'contacted' => 'contacted', 'completed' => 'completed', 'spam' => 'spam'];
        $tab = $tabMap[$_POST['status']] ?? 'new';
        
        header('Location: /admin/contact?tab=' . $tab);
    }

    // Xóa liên hệ
    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $model = new AdminContact();
        $model->delete($id);
        header('Location: /admin/contact');
    }
}