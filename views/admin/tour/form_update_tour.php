<?php
ob_start();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<?php
$selectedPolicies = [];
if (!empty($old['chinh_sach_id']) && is_array($old['chinh_sach_id'])) {
    $selectedPolicies = $old['chinh_sach_id'];
} elseif (!empty($tour['chinh_sach_ids'])) {
    $selectedPolicies = array_map('intval', explode(',', $tour['chinh_sach_ids']));
}
?>

<div class="container mt-4">
    <form action="update-tour" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $tour['id'] ?>">
        <input type="hidden" name="old_image" value="<?= $tour['hinh_anh'] ?>">
        <input type="hidden" name="old_chinh_sach_id" value="<?= htmlspecialchars($tour['chinh_sach_ids'] ?? '') ?>">

        <div class="mb-3">
            <label class="form-label">TÊN TOUR</label>
            <input type="text" name="ten_tour" class="form-control text-uppercase"
                value="<?= htmlspecialchars($old['ten_tour'] ?? $tour['ten_tour']) ?>">
            <?php if (!empty($errors['ten_tour'])): ?>
                <small class="text-danger"><?= $errors['ten_tour'] ?></small>
            <?php endif; ?>
        </div>

        <!-- Danh Mục -->
        <div class="mb-3">
            <label for="id_danh_muc" class="form-label" style="text-transform: uppercase;">DANH MỤC</label>
            <select name="id_danh_muc" id="id_danh_muc" class="form-select text-uppercase">
                <option value="">-- CHỌN DANH MỤC --</option>
                <?php foreach ($listDanhMuc as $dm): ?>
                    <option value="<?= $dm['id'] ?>" <?= ((isset($old['id_danh_muc']) && $old['id_danh_muc'] == $dm['id'])
                          || (!isset($old['id_danh_muc']) && $tour['id_danh_muc'] == $dm['id'])) ? 'selected' : '' ?>>
                        <?= strtoupper($dm['ten_danh_muc']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['id_danh_muc'])): ?>
                <span class="text-danger"><?= $errors['id_danh_muc'] ?></span>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">LỊCH TRÌNH</label>
            <textarea name="lich_trinh" class="form-control"
                rows="3"><?= htmlspecialchars($old['lich_trinh'] ?? $tour['lich_trinh']) ?></textarea>
        </div>
        <div class="mb-3">
            <!-- LỊCH TRÌNH CHI TIẾT -->
            <div class="mb-3">
                <label class="form-label"><b>LỊCH TRÌNH CHI TIẾT</b></label>

                <div id="lichTrinhContainer">
                    <?php
                    // Lấy dữ liệu lịch trình chi tiết từ $old hoặc $lichTrinh
                    $lichTrinhData = [];

                    if (!empty($old['time']) && is_array($old['time'])) {
                        // Nếu có dữ liệu từ form (sau validate lỗi)
                        foreach ($old['time'] as $i => $t) {
                            $lichTrinhData[] = [
                                'time' => $t ?? '',
                                'tieu_de' => $old['tieu_de'][$i] ?? '',
                                'mo_ta' => $old['mo_ta'][$i] ?? ''
                            ];
                        }
                    } elseif (!empty($lichTrinh) && is_array($lichTrinh)) {
                        // Nếu có dữ liệu từ database (lần đầu load hoặc không có lỗi)
                        $lichTrinhData = $lichTrinh;
                    }
                    ?>

                    <?php if (!empty($lichTrinhData)): ?>
                        <?php foreach ($lichTrinhData as $item): ?>
                            <div class="lich-trinh-row border p-3 mb-2 rounded" style="background-color: #f8f9fa;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Thời gian</label>
                                        <input type="time" name="time[]" class="form-control"
                                            value="<?= htmlspecialchars($item['time'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Tiêu đề</label>
                                        <input type="text" name="tieu_de[]" class="form-control"
                                            value="<?= htmlspecialchars($item['tieu_de'] ?? '') ?>" placeholder="VD: Khởi hành">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Mô tả</label>
                                        <input type="text" name="mo_ta[]" class="form-control"
                                            value="<?= htmlspecialchars($item['mo_ta'] ?? '') ?>"
                                            placeholder="VD: Xe đón khách tại điểm hẹn">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn btn-primary mt-2" id="addLichTrinh">
                    <i class="fas fa-plus"></i> Thêm dòng mới
                </button>
            </div>

            <script>
                $(document).ready(function () {
                    // Thêm dòng mới
                    $('#addLichTrinh').click(function (e) {
                        e.preventDefault();
                        const html = `
                    <div class="lich-trinh-row border p-3 mb-2 rounded" style="background-color: #f8f9fa;">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Thời gian</label>
                                <input type="time" name="time[]" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tiêu đề</label>
                                <input type="text" name="tieu_de[]" class="form-control" 
                                    placeholder="VD: Khởi hành">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mô tả</label>
                                <input type="text" name="mo_ta[]" class="form-control" 
                                    placeholder="VD: Xe đón khách tại điểm hẹn">
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm btn-remove">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>`;
                        $('#lichTrinhContainer').append(html);
                    });

                    // Xóa dòng
                    $(document).on('click', '.btn-remove', function (e) {
                        e.preventDefault();
                        $(this).closest('.lich-trinh-row').remove();
                    });
                });
            </script>

            <hr>


            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">HÌNH ẢNH</label>
                        <?php if (!empty($tour['hinh_anh'])): ?>
                            <div class="mb-2">
                                <img src="<?= BASE_URL ?>uploads/tours/<?= $tour['hinh_anh'] ?>" alt=""
                                    style="width:150px; border-radius:6px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="hinh_anh" class="form-control">
                        <?php if (!empty($errors['hinh_anh'])): ?>
                            <small class="text-danger"><?= $errors['hinh_anh'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">GIÁ TOUR</label>
                        <input type="number" name="gia" class="form-control" value="<?= $old['gia'] ?? $tour['gia'] ?>">
                        <?php if (!empty($errors['gia'])): ?>
                            <small class="text-danger"><?= $errors['gia'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">GIÁ KHUYẾN MÃI</label>
                        <input type="number" name="price" class="form-control"
                            value="<?= $old['price'] ?? $tour['price'] ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">NHÀ CUNG CẤP</label>
                        <input type="text" name="nha_cung_cap" class="form-control text-uppercase"
                            value="<?= htmlspecialchars($old['nha_cung_cap'] ?? $tour['nha_cung_cap']) ?>">
                        <?php if (!empty($errors['nha_cung_cap'])): ?>
                            <small class="text-danger"><?= $errors['nha_cung_cap'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="chinh_sach_id" class="form-label">CHÍNH SÁCH ÁP DỤNG</label>
                        <select class="selectpicker form-control" multiple data-live-search="true"
                            name="chinh_sach_id[]" id="chinh_sach_id">
                            <?php foreach ($listChinhSach as $cs): ?>
                                <option value="<?= $cs['id'] ?>" <?= in_array($cs['id'], $selectedPolicies) ? 'selected' : '' ?>>
                                    <?= $cs['ten_chinh_sach'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">LOẠI TOUR</label>
                        <select name="loai_tour" class="form-control">
                            <option value="Trong nước" <?= ($old['loai_tour'] ?? $tour['loai_tour']) == 'Trong nước' ? 'selected' : '' ?>>Trong nước</option>
                            <option value="Nước ngoài" <?= ($old['loai_tour'] ?? $tour['loai_tour']) == 'Nước ngoài' ? 'selected' : '' ?>>Nước ngoài</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">TRẠNG THÁI</label>
                        <select name="trang_thai" class="form-control">
                            <option value="1" <?= ($old['trang_thai'] ?? $tour['trang_thai']) == 1 ? 'selected' : '' ?>>
                                Hoạt
                                động</option>
                            <option value="0" <?= ($old['trang_thai'] ?? $tour['trang_thai']) == 0 ? 'selected' : '' ?>>Tạm
                                dừng</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">ĐỊA ĐIỂM</label>
                        <input type="text" name="dia_diem" class="form-control text-uppercase"
                            value="<?= htmlspecialchars($old['dia_diem'] ?? $tour['dia_diem']) ?>">
                        <?php if (!empty($errors['dia_diem'])): ?>
                            <small class="text-danger"><?= $errors['dia_diem'] ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>

<?php
$content = ob_get_clean();
view('layouts.AdminLayout', [
    'title' => $title ?? 'Cập nhật Tour - Website Quản Lý Tour',
    'pageTitle' => 'Cập nhật Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'tour', 'active' => false],
        ['label' => 'Cập nhật Tour', 'url' => '#', 'active' => true],
    ],
]);
?>