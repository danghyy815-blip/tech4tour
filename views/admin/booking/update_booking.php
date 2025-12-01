<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content ">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-5">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Thông tin booking
                            </h3>
                            <div class="card-tools">
                                <a href="update-booking-hdv&boooking_id=<?= $booking['id'] ?>" style="color: white;" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i> Cập nhật chuyến đi
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="update-booking-hdv">
                                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">

                                <dl class="row">

                                    <dt class="col-sm-4">Tên tour:</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control" value="<?= htmlspecialchars($booking['ten_tour']) ?>" disabled>
                                    </dd>

                                    <dt class="col-sm-4">Người phụ trách:</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="<?= htmlspecialchars($currentUser->ho_ten . ' (' . $currentUser->email . ')') ?>"
                                            disabled>
                                    </dd>

                                    <dt class="col-sm-4">Ngày khởi hành:</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="<?= date('d-m-Y', strtotime($booking['ngay_dat'])) ?>" disabled>
                                    </dd>

                                    <dt class="col-sm-4">Trạng thái:</dt>
                                    <dd class="col-sm-8">
                                        <?php
                                        $status = $booking['booking_trang_thai'];
                                        ?>

                                        <select name="trang_thai" class="form-control">
                                            <?php if ($status != 'DaXacNhan' && $status != 'Huy' && $status != 'HoanThanh'): ?>
                                                <option value="ChoDuyet" <?= $status == 'ChoDuyet' ? 'selected' : '' ?>>Chờ duyệt</option>
                                            <?php endif; ?>
                                            <?php if ($status != 'Huy' && $status != 'HoanThanh'): ?>
                                                <option value="DaXacNhan" <?= $status == 'DaXacNhan' ? 'selected' : '' ?>>Đã xác nhận</option>
                                            <?php endif; ?>

                                            <option value="Huy" <?= $status == 'Huy' ? 'selected' : '' ?>>Hủy</option>

                                            <option value="HoanThanh" <?= $status == 'HoanThanh' ? 'selected' : '' ?>>Hoàn thành</option>

                                        </select>
                                    </dd>

                                    <dt class="col-sm-4">Giá tiền</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="<?= number_format($booking['gia_tien'], 0, ',', '.') . ' VND' ?>"
                                            disabled>
                                    </dd>

                                    <dt class="col-sm-4">Loại tour</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="<?= htmlspecialchars($booking['loai_tour']) ?>"
                                            disabled>
                                    </dd>

                                    <dt class="col-sm-4">Địa điểm:</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="<?= htmlspecialchars($booking['dia_diem']) ?>"
                                            disabled>
                                    </dd>

                                    <dt class="col-sm-4">Lịch trình:</dt>
                                    <dd class="col-sm-8">
                                        <textarea class="form-control" rows="3" disabled><?= htmlspecialchars($booking['lich_trinh']) ?></textarea>
                                    </dd>

                                    <dt class="col-sm-4">Ghi chú:</dt>
                                    <dd class="col-sm-8">
                                        <textarea name="ghi_chu" class="form-control" rows="3"><?= htmlspecialchars($booking['ghi_chu']) ?></textarea>
                                    </dd>
                                </dl>

                                <div class="text-end">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-save"></i> Cập nhật Booking
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật Booking - Website Quản Lý Tour',
    'pageTitle' => 'Cập nhật Booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Cập nhật Booking', 'url' => BASE_URL . 'booking', 'active' => true],
    ],
]);
?>