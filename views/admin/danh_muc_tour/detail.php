<?php
ob_start();

?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-th-list"></i> Chi tiết danh mục Tour
                            </h3>
                            <div class="card-tools">
                                <a href="<?= BASE_URL . '?act=form-update-danh-muc-tour&id=' . $danhMuc['id'] ?>"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="<?= BASE_URL . '?act=danh-muc-tour' ?>" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">ID:</dt>
                                <dd class="col-sm-8 font-weight-bold text-primary">
                                    #<?= htmlspecialchars($danhMuc['id']) ?></dd>

                                <dt class="col-sm-4">Tên danh mục:</dt>
                                <dd class="col-sm-8 font-weight-bold"><?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>
                                </dd>

                                <dt class="col-sm-4">Loại:</dt>
                                <dd class="col-sm-8">
                                    <?php
                                    $loai_color = ($danhMuc['loai'] == 'Trong nước') ? 'success' : 'primary';
                                    ?>
                                    <span class="badge badge-<?= $loai_color ?>" style="color: #000000 !important;">
                                        <?= htmlspecialchars($danhMuc['loai']) ?>
                                    </span>
                                </dd>
                            </dl>

                            <hr>

                            <h4><i class="fas fa-book-open"></i> Mô tả</h4>
                            <div class="text-muted">
                                <p><?= nl2br(htmlspecialchars($danhMuc['mo_ta'])) ?></p>
                            </div>
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
    'title' => $title ?? 'Chi tiết danh mục - Website Quản Lý Tour',
    'pageTitle' => 'Chi tiết danh mục tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Danh mục tour', 'url' => BASE_URL . '?act=danh-muc-tour', 'active' => false],
        ['label' => 'Chi tiết', 'url' => '#', 'active' => true],
    ],
]);
?>