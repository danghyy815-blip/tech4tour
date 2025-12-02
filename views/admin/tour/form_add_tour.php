<?php
ob_start();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<?php
$selectedPolicies = $old['chinh_sach_id'] ?? [];
?>

<div class="container mt-4">
    <form action="add-tour" method="POST" enctype="multipart/form-data">

        <!-- Tên Tour -->
        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" name="ten_tour" class="form-control" value="<?= htmlspecialchars($old['ten_tour'] ?? '') ?>">
            <?php if (!empty($errors['ten_tour'])): ?>
                <small class="text-danger"><?= $errors['ten_tour'] ?></small>
            <?php endif; ?>
        </div>

        <!-- Danh mục -->
        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="id_danh_muc" class="form-select">
                <option value="">-- Chọn danh mục --</option>
                <?php foreach ($listDanhMuc as $dm): ?>
                    <option value="<?= $dm['id'] ?>" <?= ($old['id_danh_muc'] ?? '') == $dm['id'] ? 'selected' : '' ?>>
                        <?= $dm['ten_danh_muc'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if(!empty($errors['id_danh_muc'])): ?>
                <span class="text-danger"><?= $errors['id_danh_muc'] ?></span>
            <?php endif; ?>
        </div>

        <!-- Lịch trình -->
        <div class="mb-3">
            <label class="form-label">Lịch trình</label>
            <textarea name="lich_trinh" class="form-control" rows="3"><?= htmlspecialchars($old['lich_trinh'] ?? '') ?></textarea>
        </div>

        <!-- Hình ảnh + Giá -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" name="hinh_anh" class="form-control">
                    <?php if (!empty($errors['hinh_anh'])): ?>
                        <small class="text-danger"><?= $errors['hinh_anh'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Giá Tour</label>
                    <input type="number" name="gia" class="form-control" value="<?= $old['gia'] ?? '' ?>">
                    <?php if (!empty($errors['gia'])): ?>
                        <small class="text-danger"><?= $errors['gia'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Giá khuyến mãi + Nhà cung cấp -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Giá khuyến mãi</label>
                    <input type="number" name="price" class="form-control" value="<?= $old['price'] ?? '' ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nhà cung cấp</label>
                    <input type="text" name="nha_cung_cap" class="form-control" value="<?= htmlspecialchars($old['nha_cung_cap'] ?? '') ?>">
                    <?php if (!empty($errors['nha_cung_cap'])): ?>
                        <small class="text-danger"><?= $errors['nha_cung_cap'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Chính sách + Loại Tour -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="chinh_sach_id" class="form-label">CHÍNH SÁCH ÁP DỤNG</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" name="chinh_sach_id[]">
                        <?php foreach ($listChinhSach as $cs): ?>
                            <option value="<?= $cs['id'] ?>" <?= in_array($cs['id'], $selectedPolicies) ? 'selected' : '' ?>>
                                <?= $cs['ten_chinh_sach'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Loại Tour</label>
                    <select name="loai_tour" class="form-control">
                        <option value="Trong nước" <?= ($old['loai_tour'] ?? '') == 'Trong nước' ? 'selected' : '' ?>>Trong nước</option>
                        <option value="Nước ngoài" <?= ($old['loai_tour'] ?? '') == 'Nước ngoài' ? 'selected' : '' ?>>Nước ngoài</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Trạng thái + Địa điểm -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="trang_thai" class="form-control">
                        <option value="1" <?= ($old['trang_thai'] ?? '') == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="0" <?= ($old['trang_thai'] ?? '') == 0 ? 'selected' : '' ?>>Tạm dừng</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Địa điểm</label>
                    <input type="text" name="dia_diem" class="form-control" value="<?= htmlspecialchars($old['dia_diem'] ?? '') ?>">
                    <?php if (!empty($errors['dia_diem'])): ?>
                        <small class="text-danger"><?= $errors['dia_diem'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Thêm mới</button>
        <a href="tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>

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