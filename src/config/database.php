<?php
$host = 'db';
$user = 'root';
$pass = 'rootpassword';
$db   = 'webgiare_db';

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>