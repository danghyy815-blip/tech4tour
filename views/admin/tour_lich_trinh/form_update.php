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
                        <input type="hidden" name="hinh_anh_old" value="<?= $item['hinh_anh'] ?>">

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

                        <!-- NGÀY BẮT ĐẦU & KẾT THÚC -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                                    <input type="date" name="ngay_bat_dau" class="form-control"
                                        value="<?= htmlspecialchars($item['ngay_bat_dau']) ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                                    <input type="date" name="ngay_ket_thuc" class="form-control"
                                        value="<?= htmlspecialchars($item['ngay_ket_thuc']) ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- HÌNH ẢNH -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>

                            <?php if (!empty($item['hinh_anh'])): ?>
                                <div class="mb-2">
                                    <img src="<?= BASE_URL ?>public/uploads/tour_lich_trinh/<?= htmlspecialchars($item['hinh_anh']) ?>"
                                        class="img-thumbnail" style="max-width: 200px; max-height: 200px;"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                    <p class="text-danger small" style="display:none;">⚠️ Không tìm thấy ảnh</p>
                                    <p class="text-muted small mt-1">Ảnh hiện tại:
                                        <?= htmlspecialchars($item['hinh_anh']) ?></p>
                                </div>
                            <?php endif; ?>

                            <input type="file" name="hinh_anh" class="form-control" accept="image/*">
                            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>

                            <?php if (!empty($errors['hinh_anh'])): ?>
                                <small class="text-danger d-block"><?= $errors['hinh_anh'] ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- THỨ TỰ -->
                        <div class="mb-3">
                            <label class="form-label">Thứ tự <span class="text-danger">*</span></label>
                            <input type="number" name="thu_tu" class="form-control"
                                value="<?= htmlspecialchars($item['thu_tu']) ?>" min="1" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Cập nhật
                            </button>

                            <a href="tour-lich-trinh" class="btn btn-outline-secondary ms-2">
                                Hủy
                            </a>
                        </div>

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