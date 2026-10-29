<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm - Cá nhân</title>
    <!-- Nhúng Bootstrap cho đẹp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Quản lý Sản phẩm (Bài tập cá nhân)</h2>

    <!-- Form Tìm kiếm -->
    <form method="GET" action="index.php" class="mb-3 d-flex">
        <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>" class="form-control me-2" placeholder="Nhập tên sản phẩm...">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>

    <!-- Bảng Danh sách -->
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <!-- Thêm width để cố định độ rộng các cột -->
                <th style="width: 10%;">ID</th>
                <th style="width: 50%;">Tên sản phẩm</th>
                <th style="width: 20%;">Giá bán</th>
                <th style="width: 20%;" class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($products)): ?>
                <tr><td colspan="4" class="text-center">Không có sản phẩm nào.</td></tr>
            <?php endif; ?>
            
            <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['ma_san_pham'] ?></td>
                <td><?= htmlspecialchars($p['ten_san_pham']) ?></td>
                <td><?= number_format($p['gia_ban'], 0, ',', '.') ?> đ</td>
                <td class="text-center">
                    <!-- YÊU CẦU CỦA CÔ: XÓA BẰNG POST -->
                    <form method="POST" action="index.php?action=delete" onsubmit="return confirm('Chắc chắn muốn ẩn sản phẩm này?');" class="d-inline">
                        <input type="hidden" name="id" value="<?= $p['ma_san_pham'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Xóa/Ẩn</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?q=<?= urlencode($keyword) ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</body>
</html>