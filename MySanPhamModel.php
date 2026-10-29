<?php
class MySanPhamModel {
    private $db;

    public function __construct() {
        // Kết nối Database (Sửa lại user/pass nếu XAMPP của bạn có cài mật khẩu)
        $this->db = new PDO('mysql:host=localhost;dbname=mini_shop;charset=utf8mb4', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // 1. Lấy danh sách sản phẩm có Tìm kiếm & Phân trang
    public function getAll($keyword, $limit, $offset) {
        // Đã sửa DESC thành ASC để sắp xếp ID từ nhỏ đến lớn
        $sql = "SELECT * FROM san_pham WHERE ten_san_pham LIKE ? ORDER BY ma_san_pham ASC LIMIT $limit OFFSET $offset";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Đếm tổng số sản phẩm (để chia trang)
    public function countAll($keyword) {
        $sql = "SELECT COUNT(*) FROM san_pham WHERE ten_san_pham LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchColumn();
    }

    // 3. Lấy 1 sản phẩm theo ID (Dùng cho chức năng Sửa nếu bạn muốn làm thêm)
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM san_pham WHERE ma_san_pham = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Xóa (Ẩn) sản phẩm
    public function delete($id) {
        // Dùng UPDATE để ẩn sản phẩm (dang_hoat_dong = 0) thay vì xóa vĩnh viễn khỏi DB
        $stmt = $this->db->prepare("UPDATE san_pham SET dang_hoat_dong = 0 WHERE ma_san_pham = ?");
        return $stmt->execute([$id]);
    }
}