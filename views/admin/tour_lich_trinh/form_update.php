<?php
ob_start();
?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Cập nhật lịch trình</h4>
                    <a href="tour-lich-trinh" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form action="update-lich-trinh" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $item['id'] ?>">

                        <!-- CHỌN TOUR -->
                        <div class="mb-3">
                            <label class="form-label">Tour <span class="text-danger">*</span></label>
                            <select name="tour_id" class="form-select" required>
                                <?php foreach ($tours as $t): ?>
                                    <option value="<?= $t['id'] ?>" <?= $item['tour_id'] == $t['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($t['ten_tour']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- NGÀY -->
                        <div class="mb-3">
                            <label class="form-label">Ngày <span class="text-danger">*</span></label>
                            <input type="date" name="ngay_thu" class="form-control"
                                value="<?= htmlspecialchars($item['ngay_thu']) ?>" required>
                        </div>

                        <!-- TIÊU ĐỀ -->
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" name="tieu_de" class="form-control"
                                value="<?= htmlspecialchars($item['tieu_de']) ?>" required>
                        </div>

                        <!-- NỘI DUNG -->
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea name="noi_dung" class="form-control"
                                rows="4"><?= htmlspecialchars($item['noi_dung']) ?></textarea>
                        </div>

                        <!-- HÌNH ẢNH -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="hinh_anh" class="form-control">

                            <?php if (!empty($item['hinh_anh'])): ?>
                                <div class="mt-2">
                                    <img src="<?= BASE_URL . 'uploads/lich_trinh/' . $item['hinh_anh'] ?>" width="150"
                                        class="img-thumbnail">
                                </div>
                            <?php endif; ?>

                            <input type="hidden" name="hinh_anh_cu" value="<?= $item['hinh_anh'] ?>">
                        </div>

                        <!-- THỨ TỰ -->
                        <div class="mb-3">
                            <label class="form-label">Thứ tự <span class="text-danger">*</span></label>
                            <input type="number" name="thu_tu" class="form-control"
                                value="<?= htmlspecialchars($item['thu_tu']) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Cập nhật
                        </button>

                        <a href="tour-lich-trinh" class="btn btn-outline-secondary ms-2">
                            Hủy
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Cập nhật Lịch Trình',
    'pageTitle' => 'Cập nhật Lịch Trình',
    'content' => $content,
]);
?>