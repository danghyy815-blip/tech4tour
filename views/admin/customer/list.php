<?php
// Bắt đầu bộ đệm đầu ra để lưu trữ nội dung View
ob_start();

// Kiểm tra biến $customers đã được truyền từ Controller chưa
if (!isset($customers) || !is_array($customers)) {
    // Trường hợp lý tưởng là Controller luôn cung cấp mảng, nhưng thêm kiểm tra an toàn
    $customers = [];
}
?>

<style>
/* Đảm bảo chữ trong badge có màu dễ đọc */
.badge-success {
    background-color: #28a745 !important;
    color: #ffffff !important;
}

.badge-warning {
    background-color: #ffc107 !important;
    color: #212529 !important;
    /* Màu chữ tối cho nền vàng */
}

.badge-secondary {
    background-color: #6c757d !important;
    color: #ffffff !important;
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>

            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách Khách hàng</h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">ID</th>
                                        <th style="width: 20%">Họ Tên</th>
                                        <th style="width: 15%">SĐT/Email</th>
                                        <th style="width: 10%">Giới Tính</th>
                                        <th style="width: 15%">Ngày Đăng Ký</th>
                                        <th style="width: 10%">Trạng Thái</th>
                                        <th style="width: 15%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($customers)) : ?>
                                    <?php foreach ($customers as $customer) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($customer['id']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL . '?act=detail-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                class="font-weight-bold">
                                                <?= htmlspecialchars($customer['ho_ten']) ?>
                                            </a>
                                        </td>
                                        <td>
                                            SĐT: <?= htmlspecialchars($customer['so_dien_thoai']) ?><br>
                                            Email: <?= htmlspecialchars($customer['email']) ?>
                                        </td>
                                        <td><?= htmlspecialchars($customer['gioi_tinh']) ?></td>
                                        <td>
                                            <?= date('d/m/Y', strtotime(htmlspecialchars($customer['ngay_dang_ky']))) ?>
                                        </td>
                                        <td>
                                            <?php
                                                    $status = htmlspecialchars($customer['trang_thai']);
                                                    $status_color = 'secondary'; // Mặc định
                                                    if ($status == 'đang hoạt động') {
                                                        $status_color = 'success';
                                                    } elseif ($status == 'ngừng liên lạc') {
                                                        $status_color = 'warning';
                                                    }
                                                    // Trạng thái 'xóa' đã được lọc ra ở Model
                                                    ?>
                                            <span class="badge badge-<?= $status_color ?>">
                                                <?= $status ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= BASE_URL . '?act=form-update-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                class="btn btn-primary btn-sm mb-1" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="<?= BASE_URL . '?act=detail-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                class="btn btn-info btn-sm mb-1" title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="<?= BASE_URL . '?act=delete-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn XÓA (đưa vào trạng thái \'xóa\') khách hàng [<?= htmlspecialchars($customer['ho_ten']) ?>] này không?')"
                                                class="btn btn-danger btn-sm mb-1" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Chưa có khách hàng nào được thêm hoặc đang
                                            hoạt động.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark">
</aside>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "language": {
            "sProcessing": "Đang xử lý...",
            "sLengthMenu": "Xem _MENU_ mục",
            "sZeroRecords": "Không tìm thấy kết quả",
            "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ tổng số _MAX_ mục)",
            "sInfoPostFix": "",
            "sSearch": "Tìm kiếm:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Đầu",
                "sPrevious": "Trước",
                "sNext": "Tiếp",
                "sLast": "Cuối"
            },
            "oAria": {
                "sSortAscending": ": sắp xếp cột theo thứ tự tăng dần",
                "sSortDescending": ": sắp xếp cột theo thứ tự giảm dần"
            }
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>

<?php
// Kết thúc bộ đệm và lưu nội dung
$content = ob_get_clean();

// Gọi hàm view để hiển thị layout Admin
view('layouts.AdminLayout', [
    'title' => $title ?? 'Quản lý Khách Hàng - Hệ thống Khách sạn/Du lịch',
    'pageTitle' => 'Danh Sách Khách Hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý khách hàng', 'url' => BASE_URL . '?act=khach-hang', 'active' => true],
    ],
]);
?>