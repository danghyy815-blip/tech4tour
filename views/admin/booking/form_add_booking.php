<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Booking Mới</h3>
                        </div>

                        <form action="add-booking" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tour <span class="text-danger">*</span></label>
                                    <select name="tour_id" class="form-control" required>
                                        <option value="">-- Chọn tour --</option>
                                        <?php foreach ($tours as $tour): ?>
                                            <option value="<?= htmlspecialchars($tour['id']) ?>"
                                                data-price="<?= $tour['gia'] ?>"
                                                <?= isset($_POST['tour_id']) && $_POST['tour_id'] == $tour['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($tour['ten_tour']) ?> -
                                                <?= number_format($tour['gia'], 0, ',', '.') ?> VND
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Hướng dẫn viên phụ trách <span class="text-danger">*</span></label>
                                    <select name="user_id" class="form-control" required>
                                        <option value="">-- Chọn HDV --</option>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?= htmlspecialchars($user['id']) ?>"
                                                <?= isset($_POST['user_id']) && $_POST['user_id'] == $user['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($user['ho_ten']) ?>
                                                (<?= htmlspecialchars($user['email']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ngày khởi hành <span class="text-danger">*</span></label>
                                    <input type="date" name="ngay_dat" class="form-control"
                                        value="<?= htmlspecialchars($_POST['ngay_dat'] ?? '') ?>"
                                        min="<?= date('Y-m-d') ?>" required>
                                    <small class="form-text text-muted">
                                        Chọn ngày khởi hành của tour
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Giá tiền <span class="text-danger">*</span></label>
                                    <input type="number" name="gia_tien" class="form-control"
                                        value="<?= htmlspecialchars($_POST['gia_tien'] ?? '') ?>"
                                        placeholder="Nhập giá tiền" required min="0" step="1000">
                                    <small class="form-text text-muted">
                                        Đơn vị: VND
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="trang_thai" class="form-control">
                                        <option value="ChoDuyet" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 'ChoDuyet') ? 'selected' : '' ?>>Chờ duyệt</option>
                                        <option value="DaXacNhan" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 'DaXacNhan') ? 'selected' : '' ?>>Đã xác nhận</option>
                                        <option value="Huy" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 'Huy') ? 'selected' : '' ?>>Hủy</option>
                                        <option value="HoanThanh" <?= (isset($_POST['trang_thai']) && $_POST['trang_thai'] == 'HoanThanh') ? 'selected' : '' ?>>Hoàn thành</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <textarea name="ghi_chu" class="form-control" rows="4"
                                        placeholder="Nhập ghi chú (không bắt buộc)"><?= htmlspecialchars($_POST['ghi_chu'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Thêm Booking
                                </button>
                                <a href="<?= BASE_URL ?>booking" class="btn btn-default">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Thêm Booking - Website Quản Lý Tour',
    'pageTitle' => 'Thêm Booking Mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý booking', 'url' => BASE_URL . 'booking'],
        ['label' => 'Thêm mới', 'url' => '', 'active' => true],
    ],
]);
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tourSelect = document.querySelector("select[name='tour_id']");
        const priceInput = document.querySelector("input[name='gia_tien']");

        tourSelect.addEventListener("change", function() {
            const selectedOption = tourSelect.options[tourSelect.selectedIndex];
            const price = selectedOption.getAttribute("data-price");

            if (price) {
                priceInput.value = price;
            } else {
                priceInput.value = "";
            }
        });
    });
</script>