<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <?php if (getCurrentUser()->isAdmin()): ?>
                        <a href="<?= BASE_URL ?>form-add-booking" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i> Thêm Booking Mới
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        
                        <div class="card-body">
                            <table id="bookingTable" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên tour</th>
                                        <?php if (getCurrentUser()->isAdmin()): ?>
                                            <th>HDV phụ trách</th>
                                        <?php endif; ?>
                                        <th>Ngày đặt</th>
                                        <th>Giá tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $key => $booking): ?>
                                        
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . 'detail-booking&id=' . $booking['id'] ?>">
                                                    <?= htmlspecialchars($booking['ten_tour']) ?>
                                                </a>
                                            </td>
                                            <?php if (getCurrentUser()->isAdmin()): ?>
                                                <td><?= htmlspecialchars($booking['user_ho_ten'] ?? 'Chưa có') ?></td>
                                            <?php endif; ?>
                                            <td><?= date('d-m-Y', strtotime($booking['ngay_dat'])) ?></td>
                                            <td class="text-right fw-bold text-danger">
                                                <?= number_format($booking['gia_tien'], 0, ',', '.') ?> VND
                                            </td>
                                            <td>
                                                <?php 
                                                $statusClass = 'info';
                                                $statusText = 'Hoàn thành';
                                                switch ($booking['trang_thai']) {
                                                    case 'DaXacNhan':
                                                        $statusClass = 'success';
                                                        $statusText = 'Đã xác nhận';
                                                        break;
                                                    case 'ChoDuyet':
                                                        $statusClass = 'warning';
                                                        $statusText = 'Chờ duyệt';
                                                        break;
                                                    case 'Huy':
                                                        $statusClass = 'danger';
                                                        $statusText = 'Đã hủy';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                                ?>
                                                <span class="badge bg-<?= $statusClass ?> px-3 py-2">
                                                    <?= $statusText ?>
                                                </span>
                                            </td>
                                            <td>

                                                <?php if (getCurrentUser()->isAdmin()): ?>
                                                    <a href="<?= BASE_URL . 'form-update-booking&id=' . $booking['id'] ?>" 
                                                    class="btn btn-primary btn-sm me-1">
                                                    Sửa
                                                    </a>
                                                    <a href="<?= BASE_URL . 'delete-booking&id=' . $booking['id'] ?>" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tour này không?')">
                                                    Xóa
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= BASE_URL . 'check-in&id=' . $booking['id'] ?>" 
                                                        class="btn btn-primary" title="Điểm danh">
                                                        <i class="fas fa-check"></i> Điểm danh
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function() {
        // Cấu hình DataTables
        $("#bookingTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // Thêm các nút export và colvis
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"], 
            "language": {
                "search": "Tìm kiếm:",
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ bản ghi)",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Sau",
                    "previous": "Trước"
                },
                "buttons": {
                    "copy": "Sao chép",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pdf": "PDF",
                    "print": "In",
                    "colvis": "Ẩn/Hiện cột"
                }
            }
        }).buttons().container().appendTo('#bookingTable_wrapper .col-md-6:eq(0)');
    });
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý booking - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý booking', 'url' => BASE_URL . 'booking', 'active' => true],
    ],
]);
?>