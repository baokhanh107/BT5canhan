<?php
require_once 'MySanPhamController.php';

$controller = new MySanPhamController();
$action = $_GET['action'] ?? 'index'; // Mặc định là xem danh sách

// Điều hướng các hành động
switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'delete':
        // Kiểm tra nếu là POST mới cho xóa
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->delete();
        }
        break;
    // Thêm case cho sửa, thêm ở đây...
}
?>