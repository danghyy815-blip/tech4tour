<?php
ob_start();
?>

<style>
    .stats-section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid #007bff;
    }

    .small-box {
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .small-box .inner h3 {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0;
    }

    .small-box .inner p {
        font-size: 0.95rem;
        margin: 0.25rem 0 0 0;
        font-weight: 500;
    }

    .small-box-footer {
        background: rgba(0,0,0,0.1);
        color: #fff;
        display: block;
        text-align: center;
        padding: 0.65rem;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .small-box-footer:hover {
        background: rgba(0,0,0,0.2);
        color: #fff;
        text-decoration: none;
    }

    .card {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: none;
        border-top: 3px solid #007bff;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
    }

    .table-striped tbody tr:hover {
        background-color: #f5f5f5;
    }

    .badge-lg {
        font-size: 0.95rem;
        padding: 0.5rem 0.75rem;
        font-weight: 500;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <!-- Section: Key Metrics -->
            <div class="row mt-3">
                <div class="col-12">
                    <h2 class="stats-section-title">
                        <i class="fas fa-chart-bar me-2"></i>Chỉ số chính
                    </h2>
                </div>
            </div>

            <!-- Stats Cards Row 1: Customer & Staff -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalCustomers ?></h3>
                            <p>Khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?= BASE_URL . '?act=khach-hang' ?>" class="small-box-footer">
                            Xem danh sách <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalEmployees ?></h3>
                            <p>Nhân viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="<?= BASE_URL . '?act=user' ?>" class="small-box-footer">
                            Xem danh sách <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalTours ?></h3>
                            <p>Tour</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-map-location-dot"></i>
                        </div>
                        <a href="<?= BASE_URL . '?act=tour' ?>" class="small-box-footer">
                            Xem danh sách <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $totalBookings ?></h3>
                            <p>Booking</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="<?= BASE_URL_HDV . '?act=booking' ?>" class="small-box-footer">
                            Xem danh sách <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Revenue Card (Full Width) -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-top: 3px solid #667eea;">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-chart-line me-2"></i>Doanh thu tổng
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h1 style="color: #667eea; font-weight: bold; font-size: 2.5rem;">
                                        <?= number_format($totalRevenue, 0, ',', '.') ?> 
                                        <span style="font-size: 1.5rem;">₫</span>
                                    </h1>
                                    <p class="text-muted mt-2">Tổng doanh thu từ các booking đã hoàn thành</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div style="font-size: 4rem; color: #667eea; opacity: 0.1;">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Analytics & Charts -->
            <div class="row">
                <div class="col-12">
                    <h2 class="stats-section-title">
                        <i class="fas fa-chart-pie me-2"></i>Phân tích chi tiết
                    </h2>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-circle me-2" style="color: #667eea;"></i>
                                Phân bố nhân viên theo chức vụ
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="position: relative; height: 280px;">
                                <canvas id="roleChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-toggle-on me-2" style="color: #28a745;"></i>
                                Trạng thái nhân viên
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="position: relative; height: 280px;">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Detailed Table -->
            <div class="row">
                <div class="col-12">
                    <h2 class="stats-section-title">
                        <i class="fas fa-table me-2"></i>Chi tiết nhân viên theo chức vụ
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped table-hover mb-0">
                                <thead style="background-color: #f8f9fa;">
                                    <tr>
                                        <th><i class="fas fa-briefcase me-2"></i>Chức vụ</th>
                                        <th class="text-center"><i class="fas fa-users me-2"></i>Số lượng</th>
                                        <th class="text-center"><i class="fas fa-percent me-2"></i>Phần trăm</th>
                                        <th class="text-center"><i class="fas fa-bar-chart me-2"></i>Biểu đồ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usersByRole as $role) : 
                                        $percentage = $totalUsers > 0 ? round(($role['count'] / $totalUsers) * 100, 2) : 0;
                                        $roleColor = $role['chuc_vu'] === 'Admin' ? 'danger' : 'info';
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="badge badge-lg bg-<?= $roleColor ?>">
                                                    <?= htmlspecialchars($role['chuc_vu']) ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><strong><?= $role['count'] ?></strong></td>
                                            <td class="text-center">
                                                <span class="badge badge-lg bg-secondary"><?= $percentage ?>%</span>
                                            </td>
                                            <td>
                                                <div style="background-color: #e9ecef; height: 30px; border-radius: 4px; overflow: hidden;">
                                                    <div style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); height: 100%; width: <?= $percentage ?>%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.85rem; font-weight: bold;">
                                                        <?php if ($percentage > 10): echo $percentage . '%'; endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot style="background-color: #f8f9fa; font-weight: bold;">
                                    <tr>
                                        <td>Tổng cộng</td>
                                        <td class="text-center"><?= $totalUsers ?></td>
                                        <td class="text-center">100%</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Detailed Reports -->
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class="stats-section-title">
                        <i class="fas fa-file-alt me-2"></i>Báo cáo chi tiết
                    </h2>
                </div>
            </div>

            <!-- Row 1: Recent Customers & Booking Status -->
            <div class="row mb-4">
                <!-- Recent Customers -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-plus me-2" style="color: #17a2b8;"></i>
                                Khách hàng mới nhất
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <?php if (!empty($recentCustomers)): ?>
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead style="background-color: #f8f9fa;">
                                            <tr>
                                                <th>Tên khách hàng</th>
                                                <th>Email</th>
                                                <th>Ngày đăng ký</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recentCustomers as $customer): ?>
                                                <tr>
                                                    <td><strong><?= htmlspecialchars($customer['ho_ten']) ?></strong></td>
                                                    <td><small><?= htmlspecialchars($customer['email']) ?></small></td>
                                                    <td><?= date('d/m/Y', strtotime($customer['ngay_dang_ky'])) ?></td>
                                                    <td>
                                                        <span class="badge bg-success">Hoạt động</span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center p-4 text-muted">
                                    Không có dữ liệu
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Booking by Status -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list-check me-2" style="color: #ffc107;"></i>
                                Booking theo trạng thái
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php 
                                    $statusLabels = [
                                        'ChoDuyet' => 'Chờ duyệt',
                                        'DaXacNhan' => 'Đã xác nhận',
                                        'HoanThanh' => 'Hoàn thành',
                                        'Huy' => 'Đã hủy'
                                    ];
                                    $statusColors = [
                                        'ChoDuyet' => 'warning',
                                        'DaXacNhan' => 'info',
                                        'HoanThanh' => 'success',
                                        'Huy' => 'danger'
                                    ];
                                ?>
                                <?php foreach ($bookingsByStatus as $status): ?>
                                    <div class="col-6 mb-3">
                                        <div class="text-center p-3 border rounded" style="background-color: #f8f9fa;">
                                            <h4 class="mb-2">
                                                <span class="badge bg-<?= $statusColors[$status['trang_thai']] ?? 'secondary' ?>">
                                                    <?= $status['count'] ?>
                                                </span>
                                            </h4>
                                            <small class="text-muted">
                                                <?= $statusLabels[$status['trang_thai']] ?? $status['trang_thai'] ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Popular Tours & Revenue by Status -->
            <div class="row mb-4">
                <!-- Popular Tours -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-star me-2" style="color: #ffc107;"></i>
                                Top 5 tour phổ biến
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <?php if (!empty($popularTours)): ?>
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead style="background-color: #f8f9fa;">
                                            <tr>
                                                <th>Tên tour</th>
                                                <th class="text-center">Booking</th>
                                                <th class="text-right">Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($popularTours as $tour): ?>
                                                <tr>
                                                    <td>
                                                        <strong><?= htmlspecialchars($tour['ten_tour']) ?></strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-primary"><?= $tour['booking_count'] ?></span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="text-success">₫<?= number_format($tour['gia'], 0, ',', '.') ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center p-4 text-muted">
                                    Không có dữ liệu
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Revenue by Status -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-bar me-2" style="color: #28a745;"></i>
                                Doanh thu theo trạng thái
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="space-y-3">
                                <?php foreach ($revenueByStatus as $revenue): 
                                    $statusLabel = $statusLabels[$revenue['trang_thai']] ?? $revenue['trang_thai'];
                                    $statusColor = $statusColors[$revenue['trang_thai']] ?? 'secondary';
                                ?>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-<?= $statusColor ?>"><?= $statusLabel ?></span>
                                            <strong>₫<?= number_format($revenue['total'], 0, ',', '.') ?></strong>
                                        </div>
                                        <div style="background-color: #e9ecef; height: 25px; border-radius: 4px; overflow: hidden;">
                                            <div style="background: linear-gradient(90deg, #28a745 0%, #20c997 100%); height: 100%; width: <?= ($totalRevenue > 0 ? ($revenue['total'] / $totalRevenue) * 100 : 0) ?>%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: bold;">
                                                <?php if (($totalRevenue > 0 ? ($revenue['total'] / $totalRevenue) * 100 : 0) > 8): ?>
                                                    <?= round(($revenue['total'] / $totalRevenue) * 100, 1) ?>%
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<aside class="control-sidebar control-sidebar-dark"></aside>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => $title ?? 'Báo cáo thống kê - Website Quản Lý Tour',
    'pageTitle' => 'Báo cáo thống kê',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Báo cáo thống kê', 'url' => BASE_URL . '?act=report', 'active' => true],
    ],
]);
?>

<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    // Role Chart (Doughnut with better styling)
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    const roleChart = new Chart(roleCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($roleLabels) ?>,
            datasets: [{
                data: <?= json_encode($roleCounts) ?>,
                backgroundColor: [
                    '#667eea',
                    '#764ba2',
                    '#f093fb',
                    '#4facfe',
                    '#00f2fe'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 13, weight: 'bold' },
                        padding: 15,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' người';
                        }
                    }
                }
            }
        }
    });

    // Status Chart (Pie with better styling)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Kích hoạt', 'Vô hiệu'],
            datasets: [{
                data: [<?= $activeUsers ?>, <?= $inactiveUsers ?>],
                backgroundColor: [
                    '#28a745',
                    '#dc3545'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 13, weight: 'bold' },
                        padding: 15,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' người';
                        }
                    }
                }
            }
        }
    });
</script>
