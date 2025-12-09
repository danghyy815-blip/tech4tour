<?php ob_start(); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<?php
$selectedPolicies = [];
if (!empty($old['chinh_sach_id'])) {
    $selectedPolicies = $old['chinh_sach_id'];
} elseif (!empty($tour['chinh_sach_ids'])) {
    $selectedPolicies = array_map('intval', explode(',', $tour['chinh_sach_ids']));
}
?>

<style>
    .tour-form-card { border:1px solid #e5e7eb; border-radius:10px; padding:20px; background:#fff; }
    .tour-form-title { font-size:18px; font-weight:700; }
    .form-section-title { font-weight:600; margin-bottom:6px; }
    .thumb-preview { width:120px; height:80px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb; }
</style>

<div class="container mt-4">
    <div class="tour-form-card">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <div class="tour-form-title">Cập nhật Tour</div>
                <div class="text-muted" style="font-size:13px;">Điều chỉnh thông tin tour & chính sách</div>
            </div>
            <a href="tour" class="btn btn-default">Quay lại</a>
        </div>

        <form action="update-tour" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $tour['id'] ?>">
            <input type="hidden" name="old_image" value="<?= $tour['hinh_anh'] ?>">
            <input type="hidden" name="old_chinh_sach_id" value="<?= htmlspecialchars($tour['chinh_sach_ids'] ?? '') ?>">

            <!-- Tên Tour -->
            <div class="mb-3">
                <label class="form-section-title">Tên Tour</label>
                <input type="text" name="ten_tour" class="form-control" 
                       value="<?= htmlspecialchars($old['ten_tour'] ?? $tour['ten_tour']) ?>">
                <?php if (!empty($errors['ten_tour'])): ?>
                    <small class="text-danger"><?= $errors['ten_tour'] ?></small>
                <?php endif; ?>
            </div>

            <!-- Danh Mục - Loại Tour -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Danh mục</label>
                        <select name="id_danh_muc" class="form-control">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach($listDanhMuc as $dm): ?>
                                <option value="<?= $dm['id'] ?>"
                                    <?= ((isset($old['id_danh_muc']) && $old['id_danh_muc'] == $dm['id']) ||
                                        (!isset($old['id_danh_muc']) && $tour['id_danh_muc'] == $dm['id'])) 
                                        ? 'selected' : '' ?>>
                                    <?= strtoupper($dm['ten_danh_muc']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['id_danh_muc'])): ?>
                            <small class="text-danger"><?= $errors['id_danh_muc'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Loại Tour</label>
                        <select name="loai_tour" class="form-control">
                            <option value="Trong nước" 
                                <?= ($old['loai_tour'] ?? $tour['loai_tour']) == 'Trong nước' ? 'selected' : '' ?>>
                                Trong nước
                            </option>
                            <option value="Nước ngoài" 
                                <?= ($old['loai_tour'] ?? $tour['loai_tour']) == 'Nước ngoài' ? 'selected' : '' ?>>
                                Nước ngoài
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Lịch Trình -->
            <div class="mb-3">
                <label class="form-section-title">Lịch trình</label>
                <textarea name="lich_trinh" class="form-control" rows="3"><?= 
                    htmlspecialchars($old['lich_trinh'] ?? $tour['lich_trinh']) 
                ?></textarea>
            </div>

            <!-- Hình ảnh - Giá tour -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Hình ảnh</label>
                        <?php if (!empty($tour['hinh_anh'])): ?>
                            <img src="<?= BASE_URL ?>uploads/tours/<?= $tour['hinh_anh'] ?>" class="thumb-preview mb-2">
                        <?php endif; ?>
                        <input type="file" name="hinh_anh" class="form-control">
                        <?php if (!empty($errors['hinh_anh'])): ?>
                            <small class="text-danger"><?= $errors['hinh_anh'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Giá Tour</label>
                        <input type="number" name="gia" class="form-control" 
                               value="<?= $old['gia'] ?? $tour['gia'] ?>">
                        <?php if (!empty($errors['gia'])): ?>
                            <small class="text-danger"><?= $errors['gia'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Giá KM - Nhà cung cấp -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Giá khuyến mãi</label>
                        <input type="number" name="price" class="form-control" 
                               value="<?= $old['price'] ?? $tour['price'] ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Nhà cung cấp</label>
                        <input type="text" name="nha_cung_cap" class="form-control" 
                               value="<?= htmlspecialchars($old['nha_cung_cap'] ?? $tour['nha_cung_cap']) ?>">
                        <?php if (!empty($errors['nha_cung_cap'])): ?>
                            <small class="text-danger"><?= $errors['nha_cung_cap'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Chính sách - Trạng thái -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Chính sách áp dụng</label>
                        <select class="selectpicker form-control" multiple data-live-search="true" 
                                name="chinh_sach_id[]">
                            <?php foreach ($listChinhSach as $cs): ?>
                                <option value="<?= $cs['id'] ?>" 
                                    <?= in_array($cs['id'], $selectedPolicies) ? 'selected' : '' ?>>
                                    <?= $cs['ten_chinh_sach'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-section-title">Trạng thái</label>
                        <select name="trang_thai" class="form-control">
                            <option value="1" <?= ($old['trang_thai'] ?? $tour['trang_thai']) == 1 ? 'selected' : '' ?>>
                                Hoạt động
                            </option>
                            <option value="0" <?= ($old['trang_thai'] ?? $tour['trang_thai']) == 0 ? 'selected' : '' ?>>
                                Tạm dừng
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Địa điểm -->
            <div class="mb-3">
                <label class="form-section-title">Địa điểm</label>
                <input type="text" name="dia_diem" class="form-control" 
                       value="<?= htmlspecialchars($old['dia_diem'] ?? $tour['dia_diem']) ?>">
                <?php if (!empty($errors['dia_diem'])): ?>
                    <small class="text-danger"><?= $errors['dia_diem'] ?></small>
                <?php endif; ?>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="tour" class="btn btn-default">Hủy</a>
            </div>

        </form>
    </div>
</div>

<script>
$(document).ready(() => { $('.selectpicker').selectpicker(); });
</script>

<?php
$content = ob_get_clean();
view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật Tour',
    'pageTitle' => 'Cập nhật Tour',
    'content' => $content
]);
?>
