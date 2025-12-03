<?php
ob_start();

// Lấy thông tin user hiện tại
$currentUser = getCurrentUser();
$isAdmin = $currentUser->isAdmin();

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-5">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> Thông tin booking</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?= BASE_URL ?>update-booking">
                                <input type="hidden" name="booking_id" value="<?= intval($booking['id']) ?>">

                                <dl class="row">

                                    <!-- Tên tour -->
                                    <dt class="col-sm-4">Tên tour:</dt>
                                    <dd class="col-sm-8">
                                        <?php if($isAdmin): ?>
                                            <select name="tour_id" class="form-control">
                                                <?php foreach($tours as $t): ?>
                                                    <option value="<?= $t['id'] ?>" <?= $booking['tour_id'] == $t['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($t['ten_tour']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <input type="text" class="form-control" value="<?= htmlspecialchars($booking['ten_tour']) ?>" disabled>
                                        <?php endif; ?>
                                    </dd>

                                    <!-- Người phụ trách -->
                                    <dt class="col-sm-4">Người phụ trách:</dt>
                                    <dd class="col-sm-8">
                                        <?php if($isAdmin): ?>
                                            <select name="user_id" class="form-control">
                                                <?php foreach($users as $u): ?>
                                                    <option value="<?= $u['id'] ?>" <?= $booking['user_id'] == $u['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($u['ho_ten'] . ' (' . $u['email'] . ')') ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php else: ?>
                                            <input type="text" class="form-control" value="<?= htmlspecialchars($booking['user_ho_ten'] . ' (' . $booking['user_email'] . ')') ?>" disabled>
                                        <?php endif; ?>
                                    </dd>

                                    <!-- Ngày khởi hành -->
                                    <dt class="col-sm-4">Ngày khởi hành:</dt>
                                    <dd class="col-sm-8">
                                        <input type="date" class="form-control" name="ngay_dat"
                                               value="<?= !empty($booking['ngay_dat']) ? date('Y-m-d', strtotime($booking['ngay_dat'])) : '' ?>"
                                               <?= $isAdmin ? '' : 'disabled' ?>>
                                    </dd>

                                    <!-- Trạng thái -->
                                    <dt class="col-sm-4">Trạng thái:</dt>
                                    <dd class="col-sm-8">
                                        <?php
                                        $status = $booking['trang_thai'] ?? 'ChoDuyet';
                                        $options = [
                                            'ChoDuyet' => 'Chờ duyệt',
                                            'DaXacNhan' => 'Đã xác nhận',
                                            'Huy' => 'Hủy',
                                            'HoanThanh' => 'Hoàn thành'
                                        ];
                                        ?>
                                        <select name="trang_thai" class="form-control">
                                            <?php foreach ($options as $val => $label): ?>
                                                <option value="<?= $val ?>" <?= $status === $val ? 'selected' : '' ?>><?= $label ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </dd>

                                    <!-- Giá tiền -->
                                    <dt class="col-sm-4">Giá tiền:</dt>
                                    <dd class="col-sm-8">
                                        <input type="number" class="form-control" name="gia_tien"
                                               value="<?= $booking['gia_tien'] ?? '' ?>"
                                               <?= $isAdmin ? '' : 'disabled' ?>>
                                    </dd>

                                    <!-- Loại tour -->
                                    <dt class="col-sm-4">Loại tour:</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control" name="loai_tour"
                                               value="<?= htmlspecialchars($booking['loai_tour'] ?? '') ?>"
                                               <?= $isAdmin ? '' : 'disabled' ?>>
                                    </dd>

                                    <!-- Địa điểm -->
                                    <dt class="col-sm-4">Địa điểm:</dt>
                                    <dd class="col-sm-8">
                                        <input type="text" class="form-control" name="dia_diem"
                                               value="<?= htmlspecialchars($booking['dia_diem'] ?? '') ?>"
                                               <?= $isAdmin ? '' : 'disabled' ?>>
                                    </dd>

                                    <!-- Lịch trình -->
                                    <dt class="col-sm-4">Lịch trình:</dt>
                                    <dd class="col-sm-8">
                                        <textarea class="form-control" name="lich_trinh" rows="3"
                                                  <?= $isAdmin ? '' : 'disabled' ?>><?= htmlspecialchars($booking['lich_trinh'] ?? '') ?></textarea>
                                    </dd>

                                    <!-- Ghi chú -->
                                    <dt class="col-sm-4">Ghi chú:</dt>
                                    <dd class="col-sm-8">
                                        <textarea class="form-control" name="ghi_chu" rows="3"><?= htmlspecialchars($booking['ghi_chu'] ?? '') ?></textarea>
                                    </dd>

                                </dl>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
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

view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật Booking - Website Quản Lý Tour',
    'pageTitle' => 'Cập nhật Booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Cập nhật Booking', 'url' => BASE_URL . 'booking', 'active' => true],
    ],
]);
?>
