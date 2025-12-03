<?php
ob_start();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Khách Hàng Vào Booking</h3>
                        </div>
                        
                        <form method="POST" action="<?= BASE_URL ?>add-customer-to-booking">
                            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']) ?>">
                            
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> Thông tin booking</h5>
                                    <strong>Tour:</strong> <?= htmlspecialchars($booking['ten_tour']) ?><br>
                                    <strong>Ngày khởi hành:</strong> 
                                    <?= date('d-m-Y', strtotime($booking['ngay_dat'])) ?><br>
                                    <strong>HDV:</strong> 
                                    <?= htmlspecialchars($booking['hdv_name'] ?? 'Chưa có') ?><br>
                                    <strong>Giá:</strong> 
                                    <?= number_format($booking['gia_tien'] ?? 0, 0, ',', '.') ?> VND
                                </div>

                                <div class="form-group">
                                    <label>Chọn khách hàng <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <?php if (empty($allCustomers)): ?>
                                            <div class="col-12">
                                                <div class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Chưa có khách hàng nào trong hệ thống. 
                                                    <a href="<?= BASE_URL ?>form-add-khach-hang" class="alert-link">
                                                        Thêm khách hàng mới
                                                    </a>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <?php foreach ($allCustomers as $customer): ?>
                                                <?php 
                                                $isAdded = in_array($customer['id'], $bookingCustomerIds);
                                                ?>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="custom-control custom-checkbox mb-2">
                                                        <input class="custom-control-input" 
                                                               type="checkbox" 
                                                               name="customer_ids[]" 
                                                               value="<?= htmlspecialchars($customer['id']) ?>"
                                                               id="customer_<?= htmlspecialchars($customer['id']) ?>"
                                                               <?= $isAdded ? 'disabled checked' : '' ?>>
                                                        <label for="customer_<?= htmlspecialchars($customer['id']) ?>" 
                                                               class="custom-control-label">
                                                            <strong><?= htmlspecialchars($customer['ho_ten']) ?></strong><br>
                                                            <small class="text-muted">
                                                                <i class="fas fa-phone"></i> 
                                                                <?= htmlspecialchars($customer['so_dien_thoai']) ?>
                                                            </small>
                                                            <?php if ($isAdded): ?>
                                                                <span class="badge badge-success ml-2">Đã thêm</span>
                                                            <?php endif; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (!empty($bookingCustomers)): ?>
                                    <div class="alert alert-secondary mt-3">
                                        <h6>
                                            <i class="fas fa-users"></i> 
                                            Khách hàng đã có trong booking (<?= count($bookingCustomers) ?> người):
                                        </h6>
                                        <ul class="mb-0">
                                            <?php foreach ($bookingCustomers as $bc): ?>
                                                <li>
                                                    <strong><?= htmlspecialchars($bc['ho_ten']) ?></strong> - 
                                                    <i class="fas fa-phone"></i> 
                                                    <?= htmlspecialchars($bc['so_dien_thoai']) ?>
                                                    <?php if (!empty($bc['email'])): ?>
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-envelope"></i> 
                                                            <?= htmlspecialchars($bc['email']) ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-footer">
                                <?php if (!empty($allCustomers)): ?>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-user-plus"></i> Thêm Khách Hàng
                                    </button>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>detail-booking&id=<?= htmlspecialchars($booking['id']) ?>" 
                                   class="btn btn-default">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Thêm khách hàng vào Booking - Website Quản Lý Tour',
    'pageTitle' => 'Thêm Khách Hàng Vào Booking',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý booking', 'url' => BASE_URL . 'booking'],
        ['label' => 'Chi tiết booking', 'url' => BASE_URL . 'detail-booking&id=' . $booking['id']],
        ['label' => 'Thêm khách hàng', 'url' => '', 'active' => true],
    ],
]);
?>