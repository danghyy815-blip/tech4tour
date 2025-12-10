<?php
ob_start();
?>

<style>
    .tour-list-wrapper .card {
        border-radius: 10px;
    }

    .table thead th {
        background: #f5f6f8;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .thumb-sm {
        width: 90px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }

    .badge-soft-success {
        background: #eaf7ed;
        color: #1f7a3d;
    }

    .badge-soft-danger {
        background: #fdecec;
        color: #c0362c;
    }

    .badge-soft-primary {
        background: #eef4ff;
        color: #2f59c1;
    }

    .price-text {
        color: #c24d00;
        font-weight: 700;
    }

    .action-btn {
        border-radius: 6px;
        padding: 6px 10px;
    }
</style>

<div class="content-wrapper tour-list-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 d-flex align-items-center flex-wrap gap-2">
                    <div>
                        <small class="text-muted">Quản lý và theo dõi tất cả tour đang có</small>
                    </div>
                    <a href="form-add-tour" class="btn btn-success shadow-sm ms-auto">
                        <i class="bi bi-plus-circle"></i> Thêm tour mới
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tourTable" class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Tour</th>
                                            <th>Ảnh</th>
                                            <th>Giá</th>
                                            <th>Địa điểm</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Loại tour</th>
                                            <th>Trạng thái</th>
                                            <th class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tours as $key => $tour): ?>
                                            <tr>
                                                <td class="text-muted fw-semibold"><?= $key + 1 ?></td>
                                                <td>
                                                    <a href="detail-tour&id=<?= $tour['id'] ?>"
                                                        class="fw-semibold text-decoration-none">
                                                        <?= htmlspecialchars($tour['ten_tour']) ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if (!empty($tour['hinh_anh'])): ?>
                                                        <img src="uploads/tours/<?= htmlspecialchars($tour['hinh_anh']) ?>"
                                                            class="thumb-sm" alt="thumb">
                                                    <?php else: ?>
                                                        <span class="text-muted small">Không ảnh</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="price-text"><?= number_format($tour['gia']) ?>đ</td>
                                                <td><?= htmlspecialchars($tour['dia_diem']) ?></td>
                                                <td><span
                                                        class="badge badge-soft-primary px-3 py-2"><?= htmlspecialchars($tour['nha_cung_cap']) ?></span>
                                                </td>
                                                <td><?= htmlspecialchars($tour['loai_tour']) ?></td>
                                                <td>
                                                    <?php if ($tour['trang_thai'] == 1): ?>
                                                        <span class="badge badge-soft-success px-3 py-2">Hoạt động</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-soft-danger px-3 py-2">Tạm dừng</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="form-update-tour&id=<?= $tour['id'] ?>"
                                                        class="btn btn-primary btn-sm action-btn me-1">
                                                        Sửa
                                                    </a>
                                                    <a href="delete-tour&id=<?= $tour['id'] ?>"
                                                        class="btn btn-outline-danger btn-sm action-btn"
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

        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<script>
    $(function () {
        $("#tourTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "language": {
                "search": "Tìm kiếm:",
                "lengthMenu": "Hiển thị _MENU_",
                "info": "Hiển thị _START_ - _END_ / _TOTAL_ tour",
                "paginate": { "previous": "Trước", "next": "Sau" }
            }
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