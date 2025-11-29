<?php
ob_start();
?>

<div class="container mt-4">

    <form action="?act=update-tour" method="POST">
        <input type="hidden" name="id" value="<?= $tour['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" name="ten_tour" class="form-control" value="<?= htmlspecialchars($tour['ten_tour']) ?>">
            <?php if (!empty($errors['ten_tour'])): ?>
                <small class="text-danger"><?= $errors['ten_tour'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục (ID)</label>
            <input type="number" name="id_danh_muc" class="form-control" value="<?= $tour['id_danh_muc'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Lịch trình</label>
            <textarea name="lich_trinh" class="form-control" rows="3"><?= htmlspecialchars($tour['lich_trinh']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh (URL)</label>
            <input type="text" name="hinh_anh" class="form-control" value="<?= $tour['hinh_anh'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Giá Tour</label>
            <input type="number" name="gia" class="form-control" value="<?= $tour['gia'] ?>">
            <?php if (!empty($errors['gia'])): ?>
                <small class="text-danger"><?= $errors['gia'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Chính sách áp dụng (ID)</label>
            <input type="number" name="chinh_sach_id" class="form-control" value="<?= $tour['chinh_sach_id'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Nhà cung cấp</label>
            <input type="text" name="nha_cung_cap" class="form-control" value="<?= htmlspecialchars($tour['nha_cung_cap']) ?>">
            <?php if (!empty($errors['nha_cung_cap'])): ?>
                <small class="text-danger"><?= $errors['nha_cung_cap'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại Tour</label>
            <select name="loai_tour" class="form-select">
                <option value="Trong nước" <?= $tour['loai_tour'] == 'Trong nước' ? 'selected' : '' ?>>Trong nước</option>
                <option value="Nước ngoài" <?= $tour['loai_tour'] == 'Nước ngoài' ? 'selected' : '' ?>>Nước ngoài</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="trang_thai" class="form-select">
                <option value="1" <?= $tour['trang_thai'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                <option value="0" <?= $tour['trang_thai'] == 0 ? 'selected' : '' ?>>Tạm dừng</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa điểm</label>
            <input type="text" name="dia_diem" class="form-control" value="<?= htmlspecialchars($tour['dia_diem']) ?>">
            <?php if (!empty($errors['dia_diem'])): ?>
                <small class="text-danger"><?= $errors['dia_diem'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá khuyến mãi</label>
            <input type="number" name="price" class="form-control" value="<?= $tour['price'] ?>">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="?act=tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật Tour - Website Quản Lý Tour',
    'pageTitle' => 'Cập nhật Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'tour', 'active' => false],
        ['label' => 'Cập nhật Tour', 'url' => 'tour', 'active' => true],
    ],
]);
?>
