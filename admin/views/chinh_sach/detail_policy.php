<?php
// policy_detail.php
// Giả sử $policy đã có (vd: từ controller). Nếu không, bạn có thể redirect hoặc show lỗi.
// Vui lòng đảm bảo các biến $policy['key'] đã tồn tại trước khi dùng.
?>
<?php include_once './views/layout/header.php'; ?>
<?php include_once './views/layout/navbar.php'; ?>
<?php include_once './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                     Chi tiết chính sách: <strong><?= ($policy['ten_chinh_sach']) ?></strong>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL_ADMIN . '?act=/' ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL_ADMIN . '?act=policy' ?>">Quản lý chính sách</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Thông tin cơ bản
                            </h3>
                            <div class="card-tools">
                                <a  href="<?= BASE_URL_ADMIN . '?act=form-update-policy&id=' . $policy['id'] ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="?act=delete-policy&id=<?= $policy['id'] ?>" style="color: white;" onclick="return confirm('Bạn có đồng ý xóa chính sách này không?')" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Tên chính sách:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($policy['ten_chinh_sach']) ?></dd>

                                <dt class="col-sm-4">Loại chính sách:</dt>
                                <dd class="col-sm-8"><?= htmlspecialchars($policy['loai_chinh_sach']) ?></dd>

                                <dt class="col-sm-4">Ngày áp dụng:</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= date('d-m-Y', strtotime($policy['ngay_ap_dung'])) ?></span>
                                </dd>

                                <dt class="col-sm-4">Ngày hết hạn:</dt>
                                <dd class="col-sm-8">
                                    <span class=""><?= date('d-m-Y', strtotime($policy['ngay_het_han'])) ?></span>
                                </dd>

                                <dt class="col-sm-4">Trạng thái:</dt>
                                <dd class="col-sm-8">
                                    <?php
                                    // Thêm badge màu sắc dựa trên trạng thái
                                    $status_color = ($policy['trang_thai'] == 'Hoạt động') ? 'success' : 'warning';
                                    ?>
                                    <span class="badge badge-<?= $status_color ?>"><?= htmlspecialchars($policy['trang_thai']) ?></span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-align-left"></i> Mô tả chi tiết
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="text-muted">
                                <p><?= nl2br(htmlspecialchars($policy['mo_ta'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<?php include_once './views/layout/footer.php'; ?>

<script>
    function confirmDelete() {
        return confirm('Bạn chắc chắn muốn xóa chính sách này? Hành động không thể hoàn tác.');
    }
</script>