<?php
ob_start();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<?php
$selectedPolicies = [];
if (!empty($old['chinh_sach_id']) && is_array($old['chinh_sach_id'])) {
    $selectedPolicies = $old['chinh_sach_id']; // dữ liệu submit lỗi
} elseif (!empty($tour['chinh_sach_id'])) {
    $selectedPolicies = array_map('intval', explode(',', $tour['chinh_sach_id'])); // dữ liệu từ DB
}
?>

<div class="container mt-4">
    <form action="update-tour" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $tour['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $tour['hinh_anh'] ?>">

        <div class="mb-3">
            <label class="form-label">TÊN TOUR</label>
            <input type="text" name="ten_tour" class="form-control text-uppercase" value="<?= htmlspecialchars($old['ten_tour'] ?? $tour['ten_tour']) ?>">
            <?php if (!empty($errors['ten_tour'])): ?>
                <small class="text-danger"><?= $errors['ten_tour'] ?></small>
            <?php endif; ?>
        </div>

        <!-- Danh Mục -->
        <div class="mb-3">
            <label for="id_danh_muc" class="form-label" style="text-transform: uppercase;">DANH MỤC</label>
            <select name="id_danh_muc" id="id_danh_muc" class="form-select text-uppercase">
                <option value="">-- CHỌN DANH MỤC --</option>
                <?php foreach($listDanhMuc as $dm): ?>
                    <option value="<?= $dm['id'] ?>" 
                        <?= ((isset($old['id_danh_muc']) && $old['id_danh_muc']==$dm['id'])
                            || (!isset($old['id_danh_muc']) && $tour['id_danh_muc']==$dm['id'])) ? 'selected' : '' ?>>
                        <?= strtoupper($dm['ten_danh_muc']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if(!empty($errors['id_danh_muc'])): ?>
                <span class="text-danger"><?= $errors['id_danh_muc'] ?></span>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">LỊCH TRÌNH</label>
            <textarea name="lich_trinh" class="form-control" rows="3"><?= htmlspecialchars($old['lich_trinh'] ?? $tour['lich_trinh']) ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">HÌNH ẢNH</label>
                    <?php if (!empty($tour['hinh_anh'])): ?>
                        <div class="mb-2">
                            <img src="<?= BASE_URL . $tour['hinh_anh'] ?>" alt="" style="width:150px; border-radius:6px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="hinh_anh" class="form-control">
                    <?php if (!empty($errors['hinh_anh'])): ?>
                        <small class="text-danger"><?= $errors['hinh_anh'] ?></small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">GIÁ TOUR</label>
                    <input type="number" name="gia" class="form-control" value="<?= $old['gia'] ?? $tour['gia'] ?>">
                    <?php if (!empty($errors['gia'])): ?>
                        <small class="text-danger"><?= $errors['gia'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">GIÁ KHUYẾN MÃI</label>
                    <input type="number" name="price" class="form-control" value="<?= $old['price'] ?? $tour['price'] ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">NHÀ CUNG CẤP</label>
                    <input type="text" name="nha_cung_cap" class="form-control text-uppercase" value="<?= htmlspecialchars($old['nha_cung_cap'] ?? $tour['nha_cung_cap']) ?>">
                    <?php if (!empty($errors['nha_cung_cap'])): ?>
                        <small class="text-danger"><?= $errors['nha_cung_cap'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>

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
                    <input type="hidden" name="old_chinh_sach_id" value="<?= htmlspecialchars($tour['chinh_sach_id'] ?? '') ?>">
                    <script>$('.selectpicker').selectpicker();</script>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">LOẠI TOUR</label>
                    <select name="loai_tour" class="form-control">
                        <option value="Trong nước" <?= ($old['loai_tour'] ?? $tour['loai_tour'])=='Trong nước' ? 'selected' : '' ?>>Trong nước</option>
                        <option value="Nước ngoài" <?= ($old['loai_tour'] ?? $tour['loai_tour'])=='Nước ngoài' ? 'selected' : '' ?>>Nước ngoài</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">TRẠNG THÁI</label>
                    <select name="trang_thai" class="form-control">
                        <option value="1" <?= ($old['trang_thai'] ?? $tour['trang_thai'])==1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="0" <?= ($old['trang_thai'] ?? $tour['trang_thai'])==0 ? 'selected' : '' ?>>Tạm dừng</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">ĐỊA ĐIỂM</label>
                    <input type="text" name="dia_diem" class="form-control text-uppercase" value="<?= htmlspecialchars($old['dia_diem'] ?? $tour['dia_diem']) ?>">
                    <?php if (!empty($errors['dia_diem'])): ?>
                        <small class="text-danger"><?= $errors['dia_diem'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="tour" class="btn btn-secondary">Quay lại</a>
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
        ['label' => 'Cập nhật Tour', 'url' => '#', 'active' => true],
    ],
]);
?>
