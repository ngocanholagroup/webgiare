<?php
// src/test_db.php

// 1. Bật hiển thị lỗi để nếu chết thì biết chết ở đâu
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Gọi file Database (Lưu ý đường dẫn)
require_once 'models/Database.php';

try {
    // 3. Thử kết nối
    $conn = Database::getConnection();
    
    echo "<h1 style='color:green'>✅ KẾT NỐI THÀNH CÔNG!</h1>";
    echo "<p>Host: " . getenv('DB_HOST') . "</p>";
    echo "<p>Database: " . getenv('DB_NAME') . "</p>";
    
    // 4. Thử query thử 1 cái xem có dữ liệu chưa
    $stmt = $conn->query("SELECT VERSION()");
    $ver = $stmt->fetchColumn();
    echo "<p>MySQL Version: " . $ver . "</p>";
    
    // Kiểm tra bảng template_categories
    $stmt = $conn->query("SELECT count(*) FROM template_categories");
    $count = $stmt->fetchColumn();
    echo "<p>Số lượng danh mục: <b>$count</b></p>";

} catch (PDOException $e) {
    echo "<h1 style='color:red'>❌ KẾT NỐI THẤT BẠI</h1>";
    echo "<h3>Lỗi chi tiết:</h3>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>