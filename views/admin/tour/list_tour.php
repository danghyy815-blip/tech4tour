<?php
ob_start();
?>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <a href="form-add-tour" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm tour mới
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table id="tourTable" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Tour</th>
                                        <th>Ảnh</th>
                                        <th>Giá</th>
                                        <th>Địa điểm</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Loại tour</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tours as $key => $tour): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><a href="detail-tour&id=<?= $tour['id'] ?>"><?= $tour['ten_tour'] ?></a>
                                            </td>
                                            <td>
                                                <?php if (!empty($tour['hinh_anh'])): ?>
                                                    <img src="uploads/tours/<?= htmlspecialchars($tour['hinh_anh']) ?>"
                                                        class="img-fluid rounded shadow-sm" width="150">
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-danger fw-bold"><?= number_format($tour['gia']) ?>đ</td>
                                            <td><?= $tour['dia_diem'] ?></td>
                                            <td><?= $tour['nha_cung_cap'] ?></td>
                                            <td><?= $tour['loai_tour'] ?></td>
                                            <td>
                                                <?php if ($tour['trang_thai'] == 1): ?>
                                                    <span class="badge bg-success px-3 py-2">Hoạt động</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger px-3 py-2">Tạm dừng</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="form-update-tour&id=<?= $tour['id'] ?>"
                                                    class="btn btn-primary btn-sm me-1">
                                                    Sửa
                                                </a>
                                                <a href="delete-tour&id=<?= $tour['id'] ?>" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tour này không?')">
                                                    Xóa
                                                </a>
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

<aside class="control-sidebar control-sidebar-dark"></aside>

<script>
    $(function() {
        $("#tourTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tourTable_wrapper .col-md-6:eq(0)');
    });
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Quản lý Tour - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'tour', 'active' => true],
    ],
]);
?>