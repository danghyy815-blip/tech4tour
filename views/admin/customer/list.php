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
    .cust-card { border-radius: 10px; border: 1px solid #e5e7eb; }
    .cust-card .card-header { background: #f8fafc; border-bottom: 1px solid #e5e7eb; }
    .cust-table thead th { background: #f5f6f8; color: #1f2b3d; }
    .cust-table tbody td { vertical-align: middle; }
    .badge-success { background-color: #e6f4ea !important; color: #1f7a3d !important; }
    .badge-warning { background-color: #fff7e6 !important; color: #b45309 !important; }
    .badge-secondary { background-color: #f1f2f4 !important; color: #475467 !important; }
    .customer-name { text-decoration: none; color: #0f4db8; font-weight: 600; }
    .customer-name:hover { text-decoration: underline; }
    .action-btn { border-radius: 6px; padding: 6px 10px; }
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
                    <div class="card cust-card shadow-sm">
                        <div class="card-header d-flex align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="mb-0 fw-semibold">Danh sách Khách hàng</h5>
                                <small class="text-muted">Quản lý thông tin liên hệ và trạng thái</small>
                            </div>
                            <a href="<?= BASE_URL . 'form-add-khach-hang' ?>" class="btn btn-success ms-auto">
                                <i class="fas fa-plus-circle"></i> Thêm khách hàng
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-hover align-middle cust-table">
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
                                                    <a href="<?= BASE_URL . 'detail-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                        class="font-weight-bold customer-name">
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
                                                    <a href="<?= BASE_URL . 'form-update-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                        class="btn btn-primary btn-sm action-btn me-1" title="Sửa">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="<?= BASE_URL . 'delete-khach-hang&id=' . htmlspecialchars($customer['id']) ?>"
                                                        class="btn btn-outline-danger btn-sm action-btn"
                                                        onclick="return confirm('Bạn có chắc chắn muốn XÓA (đưa vào trạng thái \'xóa\') khách hàng [<?= htmlspecialchars($customer['ho_ten']) ?>] này không?')"
                                                        title="Xóa">
                                                        <i class="fas fa-trash"></i> Xóa
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
        ['label' => 'Quản lý khách hàng', 'url' => BASE_URL . 'khach-hang', 'active' => true],
    ],
]);
?>