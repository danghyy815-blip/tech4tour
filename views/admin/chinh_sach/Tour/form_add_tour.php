<?php
ob_start();
?>

<div class="container mt-4">

    <form action="?act=add-tour" method="POST">

        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" name="ten_tour" class="form-control"
                value="<?= htmlspecialchars($old['ten_tour'] ?? '') ?>">
            <?php if (!empty($errors['ten_tour'])): ?>
                <small class="text-danger"><?= $errors['ten_tour'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục (ID)</label>
            <input type="number" name="id_danh_muc" class="form-control" value="<?= $old['id_danh_muc'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Lịch trình</label>
            <textarea name="lich_trinh" class="form-control"
                rows="3"><?= htmlspecialchars($old['lich_trinh'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh</label>
            <input type="text" name="hinh_anh" class="form-control"
                value="<?= htmlspecialchars($old['hinh_anh'] ?? '') ?>">
            <?php if (!empty($errors['hinh_anh'])): ?>
                <small class="text-danger"><?= $errors['hinh_anh'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá Tour</label>
            <input type="number" name="gia" class="form-control" value="<?= $old['gia'] ?? '' ?>">
            <?php if (!empty($errors['gia'])): ?>
                <small class="text-danger"><?= $errors['gia'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Chính sách áp dụng (ID)</label>
            <input type="number" name="chinh_sach_id" class="form-control" value="<?= $old['chinh_sach_id'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Nhà cung cấp</label>
            <input type="text" name="nha_cung_cap" class="form-control"
                value="<?= htmlspecialchars($old['nha_cung_cap'] ?? '') ?>">
            <?php if (!empty($errors['nha_cung_cap'])): ?>
                <small class="text-danger"><?= $errors['nha_cung_cap'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại Tour</label>
            <select name="loai_tour" class="form-select">
                <option value="Trong nước" <?= (isset($old['loai_tour']) && $old['loai_tour'] == 'Trong nước') ? 'selected' : '' ?>>Trong nước</option>
                <option value="Nước ngoài" <?= (isset($old['loai_tour']) && $old['loai_tour'] == 'Nước ngoài') ? 'selected' : '' ?>>Nước ngoài</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="trang_thai" class="form-select">
                <option value="1" <?= (isset($old['trang_thai']) && $old['trang_thai'] == 1) ? 'selected' : '' ?>>Hoạt động
                </option>
                <option value="0" <?= (isset($old['trang_thai']) && $old['trang_thai'] == 0) ? 'selected' : '' ?>>Tạm dừng
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa điểm</label>
            <input type="text" name="dia_diem" class="form-control"
                value="<?= htmlspecialchars($old['dia_diem'] ?? '') ?>">
            <?php if (!empty($errors['dia_diem'])): ?>
                <small class="text-danger"><?= $errors['dia_diem'] ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá khuyến mãi</label>
            <input type="number" name="price" class="form-control" value="<?= $old['price'] ?? '' ?>">
        </div>

        <button type="submit" class="btn btn-success">Thêm mới</button>
        <a href="?act=tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Thêm Tour - Website Quản Lý Tour',
    'pageTitle' => 'Thêm Tour mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'tour', 'active' => false],
        ['label' => 'Thêm Tour', 'url' => '#', 'active' => true],
    ],
]);
?>