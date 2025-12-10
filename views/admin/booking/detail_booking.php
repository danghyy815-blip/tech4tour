<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid mb-5">

            <!-- Thông tin booking -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-5">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Thông tin booking
                            </h3>
                            <div class="card-tools">
                                <?php $currentUser = getCurrentUser(); ?>
                                <?php if ($currentUser->isAdmin()): ?>
                                    <a href="<?= BASE_URL ?>form-update-booking&id=<?= $booking['id'] ?>"
                                        class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i> Sửa booking
                                    </a>
                                <?php else: ?>
                                    <a href="<?= BASE_URL ?>update-booking-hdv-form&booking_id=<?= $booking['id'] ?>"
                                        class="btn btn-sm btn-success text-white">
                                        <i class="fas fa-edit"></i> Cập nhật chuyến đi
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Tên tour:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($booking['ten_tour'] ?? '') ?></dd>

                                <dt class="col-sm-4">Người phụ trách:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($booking['user_ho_ten'] ?? 'Chưa có') ?></dd>

                                <dt class="col-sm-4">Ngày khởi hành:</dt>
                                <dd class="col-sm-8">
                                    <?= !empty($booking['ngay_dat']) ? date('d-m-Y', strtotime($booking['ngay_dat'])) : '' ?>
                                </dd>


                                <dt class="col-sm-4">Trạng thái</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?php
                                    if ($booking['booking_trang_thai'] == "DaXacNhan")
                                        echo "Đã xác nhận";
                                    else if ($booking['booking_trang_thai'] == "ChoDuyet")
                                        echo "Chờ duyệt";
                                    else if ($booking['booking_trang_thai'] == "Huy")
                                        echo "Đã huỷ";
                                    else if ($booking['booking_trang_thai'] == "HoanThanh")
                                        echo "Hoàn thành";
                                    ?></span>
                                </dd>

                                <dt class="col-sm-4">Giá tiền:</dt>
                                <dd class="col-sm-8">
                                    <span class="text-success font-weight-bold">
                                        <?= isset($booking['gia_tien']) ? number_format($booking['gia_tien'], 0, ',', '.') . ' VND' : '' ?>
                                    </span>
                                </dd>

                                <dt class="col-sm-4">Loại tour:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($booking['loai_tour'] ?? '') ?></dd>

                                <dt class="col-sm-4">Địa điểm:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($booking['dia_diem'] ?? '') ?></dd>

                                <dt class="col-sm-4">Lịch trình:</dt>
                                <dd class="col-sm-8"><?= nl2br(htmlspecialchars($booking['lich_trinh'] ?? '')) ?></dd>

                                <dt class="col-sm-4">Ghi chú:</dt>
                                <dd class="col-sm-8"><?= nl2br(htmlspecialchars($booking['ghi_chu'] ?? '')) ?></dd>

                                <dt class="col-sm-4">Hình ảnh:</dt>
                                <dd class="col-sm-8">
                                    <img src="<?= BASE_URL . 'uploads/tours/' . ($booking['hinh_anh'] ?? 'default.png') ?>"
                                        alt="Ảnh tour" style="max-width:200px;border-radius:8px;">
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <!-- LỊCH TRÌNH CHI TIẾT -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Lịch trình của tour</h5>
                        </div>

                        <div class="card-body">
                            <?php if (empty($lichTrinh)): ?>
                                <p class="text-muted">Tour này chưa có lịch trình.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table id="lichTrinhTable" class="table table-striped table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Thứ tự</th>
                                                <th>Nội dung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lichTrinh as $lt): ?>
                                                <tr>
                                                    <td><?= $lt['id'] ?></td>

                                                    <td>
                                                        <?php if (!empty($lt['hinh_anh'])): ?>
                                                            <?php
                                                            $imagePath = BASE_URL . 'public/uploads/tour_lich_trinh/' . htmlspecialchars($lt['hinh_anh']);
                                                            ?>
                                                            <img src="<?= $imagePath ?>" class="thumb-sm" alt="thumb"
                                                                style="width: 150px; height: 100px;"
                                                                onerror="console.error('Image not found:', this.src); this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                            <span class="text-danger small" style="display:none;">Ảnh lỗi</span>
                                                        <?php else: ?>
                                                            <span class="text-muted small">Không có ảnh</span>
                                                        <?php endif; ?>
                                                    </td>

                                                    <!-- Tiêu đề -->
                                                    <td><?= htmlspecialchars($lt['tieu_de']) ?></td>

                                                    <!-- Ngày bắt đầu -->
                                                    <td><?= !empty($lt['ngay_bat_dau']) ? date("d/m/Y", strtotime($lt['ngay_bat_dau'])) : '---' ?>
                                                    </td>

                                                    <!-- Ngày kết thúc -->
                                                    <td><?= !empty($lt['ngay_ket_thuc']) ? date("d/m/Y", strtotime($lt['ngay_ket_thuc'])) : '---' ?>
                                                    </td>

                                                    <!-- Thứ tự -->
                                                    <td><?= $lt['thu_tu'] ?></td>

                                                    <!-- Nội dung -->
                                                    <td style="white-space: pre-line;">
                                                        <?= nl2br(htmlspecialchars($lt['noi_dung'])) ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <script>
                        $(function () {
                            $("#lichTrinhTable").DataTable({
                                responsive: true,
                                lengthChange: false,
                                autoWidth: false,
                                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                            }).buttons()
                                .container()
                                .appendTo('#lichTrinhTable_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                    <!-- Danh sách khách hàng -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-users"></i> Khách hàng trong tour
                                <span class="badge badge-primary"><?= count($customers) ?></span>
                            </h3>
                            <div class="card-tools">
                                <a href="<?= BASE_URL ?>add-khach-hang-vao-booking&id=<?= $booking['id'] ?>"
                                    class="btn btn-sm btn-success text-white">
                                    <i class="fas fa-user-plus"></i> Thêm khách hàng
                                </a>

                                <?php if (!$currentUser->isAdmin()): ?>
                                    <a href="<?= BASE_URL ?>check-in&id=<?= $booking['id'] ?>"
                                        class="btn btn-sm btn-primary text-white">
                                        <i class="fas fa-check"></i> Điểm danh
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body">

                            <?php if (empty($customers)): ?>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> Chưa có khách hàng nào.
                                </div>
                            <?php else: ?>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên khách hàng</th>
                                                <th>Giới tính</th>
                                                <th>SĐT</th>
                                                <th>Ghi chú</th>
                                                <th>Trạng thái</th>
                                                <th>Điểm danh</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($customers as $key => $c): ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>

                                                    <td><?= htmlspecialchars($c['ho_ten'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($c['gioi_tinh'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($c['so_dien_thoai'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($c['ghi_chu'] ?? '') ?></td>

                                                    <td>
                                                        <?php
                                                        $st = $c['trang_thai'] ?? '';
                                                        $stColor = match ($st) {
                                                            'active' => 'success',
                                                            'inactive' => 'danger',
                                                            'pending' => 'warning',
                                                            default => 'secondary'
                                                        };
                                                        $stText = match ($st) {
                                                            'active' => 'Đang hoạt động',
                                                            'inactive' => 'Ngưng hoạt động',
                                                            'pending' => 'Đang chờ',
                                                            default => 'Không rõ'
                                                        };
                                                        ?>
                                                        <span class="badge bg-<?= $stColor ?>"><?= $stText ?></span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $dd = $c['diem_danh'] ?? null;
                                                        if ($dd === '1' || $dd === 1) {
                                                            echo '<span class="badge bg-success"><i class="fas fa-check"></i> Có mặt</span>';
                                                        } elseif ($dd === '0' || $dd === 0) {
                                                            echo '<span class="badge bg-secondary">Chưa điểm danh</span>';
                                                        } else {
                                                            echo '<span class="badge bg-danger"><i class="fas fa-times"></i> Vắng mặt</span>';
                                                        }
                                                        ?>
                                                    </td>

                                                    <!-- XÓA -->
                                                    <td>
                                                        <a href="<?= BASE_URL ?>remove-customer-from-booking&booking_id=<?= $booking['id'] ?>&customer_id=<?= $c['khach_hang_id'] ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa tour này không?')">
                                                            Xóa
                                                        </a>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
view('layouts.AdminLayout', [
    'title' => 'Chi tiết Booking - Website Quản Lý Tour',
    'pageTitle' => 'Chi tiết Booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý booking', 'url' => BASE_URL . 'booking'],
        ['label' => 'Chi tiết', 'url' => '', 'active' => true],
    ],
]);
?>