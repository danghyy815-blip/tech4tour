<?php
ob_start();
?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Thêm lịch trình mới</h4>
                    <a href="tour-lich-trinh" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form action="add-lich-trinh" method="POST" enctype="multipart/form-data">

                        <!-- CHỌN TOUR -->
                        <div class="mb-3">
                            <label class="form-label">Tour <span class="text-danger">*</span></label>
                            <select name="tour_id" class="form-select" required>
                                <option value="">-- Chọn tour --</option>
                                <?php foreach ($tours as $tour): ?>
                                    <option value="<?= $tour['id'] ?>">
                                        <?= htmlspecialchars($tour['ten_tour']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- NGÀY THỨ -->
                        <div class="mb-3">
                            <label class="form-label">Ngày <span class="text-danger">*</span></label>
                            <input type="date" name="ngay_thu" class="form-control" required>
                        </div>

                        <!-- TIÊU ĐỀ -->
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" name="tieu_de" class="form-control" placeholder="Nhập tiêu đề..."
                                required>
                        </div>

                        <!-- NỘI DUNG -->
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea name="noi_dung" rows="4" class="form-control"
                                placeholder="Nhập nội dung..."></textarea>
                        </div>

                        <!-- HÌNH ẢNH -->
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="hinh_anh" class="form-control">
                        </div>

                        <!-- THỨ TỰ -->
                        <div class="mb-3">
                            <label class="form-label">Thứ tự <span class="text-danger">*</span></label>
                            <input type="number" name="thu_tu" class="form-control" value="1" required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Thêm mới
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
    'title' => 'Thêm Lịch Trình',
    'pageTitle' => 'Thêm Lịch Trình',
    'content' => $content,
]);
?>