<div class="container mt-4">
    <h3 class="mb-3">Chi tiết Tour</h3>

    <div class="card shadow">
        <div class="card-body">

            <h4><?= $tour['ten_tour'] ?></h4>

            <p><strong>Địa điểm:</strong> <?= $tour['dia_diem'] ?></p>
            <p><strong>Giá:</strong> <?= number_format($tour['gia']) ?>đ</p>
            <p><strong>Nhà cung cấp:</strong> <?= $tour['nha_cung_cap'] ?></p>
            <p><strong>Loại tour:</strong> <?= $tour['loai_tour'] ?></p>
            <p><strong>Trạng thái:</strong>
                <?= $tour['trang_thai'] == 1 ? 'Hoạt động' : 'Tạm dừng' ?>
            </p>
            <p><strong>Lịch trình:</strong></p>
            <div class="border p-3 bg-light"><?= nl2br($tour['lich_trinh']) ?></div>

            <p class="mt-3"><strong>Hình ảnh:</strong></p>
            <img src="<?= $tour['hinh_anh'] ?>" class="img-fluid rounded shadow-sm" width="400">

            <div class="mt-4">
                <a href="?act=tour-update&id=<?= $tour['id'] ?>" class="btn btn-warning">Sửa</a>
                <a href="?act=tour" class="btn btn-secondary">Quay lại</a>
            </div>

        </div>
    </div>
</div>
