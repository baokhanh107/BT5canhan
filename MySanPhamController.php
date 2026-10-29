<?php
require_once 'MySanPhamModel.php';

class MySanPhamController {
    private $model;

    public function __construct() {
        $this->model = new MySanPhamModel();
    }

    public function index() {
        $keyword = $_GET['q'] ?? '';
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        $limit = 5; // 5 sản phẩm 1 trang
        $offset = ($page - 1) * $limit;

        $products = $this->model->getAll($keyword, $limit, $offset);
        $total = $this->model->countAll($keyword);
        $totalPages = ceil($total / $limit);

        // Gọi View và truyền dữ liệu sang
        require 'MySanPhamView.php';
    }

    public function delete() {
        $id = $_POST['id'] ?? 0;
        if ($id > 0) {
            $this->model->delete($id);
        }
        // Xóa xong quay về trang chủ
        header("Location: index.php");
        exit();
    }
}