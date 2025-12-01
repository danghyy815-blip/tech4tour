<?php
ob_start();
?>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên tour</th>
                                        <th>Ngày đặt</th>
                                        <th>Giá tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $key => $booking) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><a href="<?= BASE_URL . 'detail-booking&id=' . $booking['id'] ?>"><?= $booking['ten_tour'] ?></a></td>
                                            <td><?= date('d-m-Y', strtotime($booking['ngay_dat'])) ?></td>
                                            <td><?= $booking['gia_tien'] ?></td>
                                            <td><?php if ($booking['trang_thai'] == "DaXacNhan") echo "Đã xác nhận";
                                                else if ($booking['trang_thai'] == "ChoDuyet") echo "Chờ duyệt";
                                                else if ($booking['trang_thai'] == "Hủy") echo "Hủy";
                                                else echo "Đã hoàn thành"; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm">
                                                    <a href="<?= BASE_URL . 'delete-booking&id=' . $booking['id'] ?>" style="color: white;">Sửa</a>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <a href="<?= BASE_URL . 'delete-booking&id=' . $booking['id'] ?>" style="color: white;">Xóa</a>
                                                </button>

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

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

</body>

</html>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title ?? 'Quản lý booking - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý booking', 'url' => BASE_URL . 'booking', 'active' => true],
    ],
]);
?>