<?php
ob_start();
?>
<style>
    :root {
        --primary-color: #4a6cf7;
        --secondary-color: #6f87ff;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --info-color: #3b82f6;
        --light-bg: #f8fafc;
        --border-color: #e2e8f0;
        --text-dark: #1e293b;
        --text-light: #64748b;
    }

    * {
        box-sizing: border-box;
    }

    /* Card đẹp hiện đại */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: none;
        overflow: hidden;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .inner {
        color: #f1f1f1ff;
    }

    .card-header {
        padding: 18px 22px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #fff !important;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        color: #fff;
    }

    .small-box-footer {
        color: #e4e4e4ff !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .small-box-footer:hover {
        color: #fff !important;
        transform: translateX(4px);
    }

    .small-box {
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 5px solid transparent;
        overflow: hidden;
        position: relative;
    }

    .small-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.3), transparent);
    }

    .small-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    }

    .small-box.bg-info {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
        border-left-color: #60a5fa;
    }

    .small-box.bg-primary {
        background: linear-gradient(135deg, #4a6cf7, #2563eb) !important;
        border-left-color: #7c3aed;
    }

    .small-box.bg-success {
        background: linear-gradient(135deg, #10b981, #059669) !important;
        border-left-color: #34d399;
    }

    .small-box.bg-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706) !important;
        border-left-color: #fbbf24;
    }

    .small-box.bg-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        border-left-color: #f87171;
    }

    .small-box .icon {
        position: absolute;
        right: 15px;
        top: 15px;
        font-size: 80px;
        opacity: 0.2;
        z-index: 1;
    }

    .small-box .inner {
        position: relative;
        z-index: 2;
    }

    .small-box .inner h3 {
        font-size: 32px;
        font-weight: 700;
        margin: 10px 0;
    }

    .small-box .inner p {
        margin: 5px 0;
        font-size: 14px;
        font-weight: 500;
        opacity: 0.95;
    }

    .card-body {
        padding: 22px 24px;
        background: #fff;
    }

    .chart {
        position: relative;
        height: 300px;
        margin-bottom: 10px;
    }

    .chart canvas {
        max-height: 300px;
    }

    /* Table styling */
    .table {
        margin: 0;
        border-collapse: collapse;
    }

    .table thead th {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white !important;
        font-weight: 600;
        border: none;
        padding: 16px;
        text-align: left;
    }

    .table tbody td {
        padding: 14px 16px;
        border-color: var(--border-color);
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: var(--light-bg);
        box-shadow: inset 3px 0 0 var(--primary-color);
    }

    .table tbody tr:last-child {
        border-bottom: 2px solid var(--border-color);
    }

    /* Badge styling */
    .badge-success {
        background: #d1fae5;
        color: #1b5e20;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-danger {
        background: #ffcdd2;
        color: #b71c1c;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Stats header */
    .stats-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .stats-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .stats-subtitle {
        font-size: 14px;
        color: var(--text-light);
        margin: 5px 0 0 0;
    }

    /* Row spacing */
    .row {
        margin-bottom: 25px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .small-box {
            margin-bottom: 15px;
        }

        .small-box .icon {
            font-size: 50px;
        }

        .small-box .inner h3 {
            font-size: 24px;
        }

        .chart {
            height: 250px;
        }
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Header section -->
            <div class="stats-header">
                <h2 class="stats-title">📊 Bảng Điều Khiển Thống Kê</h2>
                <p class="stats-subtitle">Tổng quan về hoạt động của hệ thống quản lý tour du lịch</p>
            </div>

            <!-- Main Stats row -->
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalCustomers ?></h3>
                            <p>Khách Hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="<?= BASE_URL . 'khach-hang' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $totalEmployees ?></h3>
                            <p>Nhân Viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="<?= BASE_URL . 'user' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalBookings ?></h3>
                            <p>Booking</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="<?= BASE_URL . 'booking' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalTours ?></h3>
                            <p>Tour</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hiking"></i>
                        </div>
                        <a href="<?= BASE_URL . 'tour' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="small-box" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9) !important; border-left-color: #c4b5fd;">
                        <div class="inner">
                            <h3><?= $totalPolicies ?></h3>
                            <p>Chính Sách</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <a href="<?= BASE_URL . 'policy' ?>" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= number_format($totalRevenue, 0, ',', '.') ?> đ</h3>
                            <p>Doanh Thu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="#" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Charts row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- Role Distribution Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">📋 Phân bố nhân viên theo vai trò</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($roleCounts)): ?>
                                <div class="chart">
                                    <canvas id="roleChart"></canvas>
                                </div>
                            <?php else: ?>
                                <div style="text-align: center; padding: 40px; color: #999;">
                                    <i class="fas fa-inbox" style="font-size: 48px;"></i>
                                    <p style="margin-top: 10px;">Không có dữ liệu</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- User Status Chart -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">👥 Thống kê trạng thái người dùng</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Detailed stats table row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">📊 Bảng thống kê chi tiết vai trò nhân viên</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <?php if (!empty($usersByRole)): ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <i class="fas fa-briefcase"></i> Chức Vụ
                                            </th>
                                            <th style="text-align: center;">
                                                <i class="fas fa-count"></i> Số Lượng
                                            </th>
                                            <th style="text-align: center;">
                                                <i class="fas fa-percentage"></i> Phần Trăm
                                            </th>
                                            <th style="text-align: center;">
                                                <i class="fas fa-tasks"></i> Hành Động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $totalCount = 0;
                                        foreach ($usersByRole as $role) {
                                            $totalCount += $role['count'];
                                        }
                                        foreach ($usersByRole as $role) : 
                                            $percentage = $totalCount > 0 ? round(($role['count'] / $totalCount) * 100, 2) : 0;
                                        ?>
                                            <tr>
                                                <td>
                                                    <strong><?= htmlspecialchars($role['chuc_vu']) ?></strong>
                                                </td>
                                                <td style="text-align: center;">
                                                    <span style="display: inline-block; background: linear-gradient(135deg, #4a6cf7, #6f87ff); color: white; padding: 5px 12px; border-radius: 20px; font-weight: 600;">
                                                        <?= $role['count'] ?>
                                                    </span>
                                                </td>
                                                <td style="text-align: center;">
                                                    <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                                        <div style="width: 120px; height: 20px; background: #e2e8f0; border-radius: 10px; overflow: hidden;">
                                                            <div style="height: 100%; background: linear-gradient(90deg, #10b981, #059669); width: <?= $percentage ?>%; border-radius: 10px;"></div>
                                                        </div>
                                                        <span style="font-weight: 600; min-width: 45px;"><?= $percentage ?>%</span>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?= BASE_URL . 'user' ?>" class="btn btn-sm btn-primary" title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div style="text-align: center; padding: 40px; color: #999;">
                                    <i class="fas fa-inbox" style="font-size: 48px;"></i>
                                    <p style="margin-top: 10px;">Chưa có dữ liệu nhân viên</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Detailed User List by Role -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">👤 Danh Sách Chi Tiết Người Dùng Theo Chức Vụ</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($userDetailsByRole)): ?>
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px;">
                                    <?php foreach ($userDetailsByRole as $role => $users): ?>
                                        <div style="border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                            <!-- Role Header -->
                                            <div style="background: linear-gradient(135deg, #4a6cf7, #6f87ff); padding: 15px; color: white;">
                                                <h4 style="margin: 0; font-size: 15px; font-weight: 700;">
                                                    <i class="fas fa-briefcase"></i> <?= htmlspecialchars($role) ?>
                                                </h4>
                                                <p style="margin: 5px 0 0 0; font-size: 12px; color: rgba(255, 255, 255, 0.9);">
                                                    Tổng: <strong><?= count($users) ?></strong> người
                                                </p>
                                            </div>

                                            <!-- User List -->
                                            <div style="padding: 12px;">
                                                <?php if (!empty($users)): ?>
                                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                                        <?php foreach ($users as $user): ?>
                                                            <li style="padding: 10px 12px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                                                                <div>
                                                                    <p style="margin: 0 0 3px 0; font-weight: 600; color: var(--text-dark); font-size: 13px;">
                                                                        <i class="fas fa-user-circle" style="color: #4a6cf7; margin-right: 6px;"></i>
                                                                        <?= htmlspecialchars($user['ho_ten']) ?>
                                                                    </p>
                                                                    <p style="margin: 0; color: var(--text-light); font-size: 12px; word-break: break-all;">
                                                                        <?= htmlspecialchars($user['email']) ?>
                                                                    </p>
                                                                </div>
                                                                <span style="display: inline-block; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; white-space: nowrap; margin-left: 10px; <?php if ($user['trang_thai'] == 1): ?>background: #d1fae5; color: #065f46;<?php else: ?>background: #fee2e2; color: #b91c1c;<?php endif; ?>">
                                                                    <?php echo $user['trang_thai'] == 1 ? '✓ Hoạt động' : '✗ Vô hiệu'; ?>
                                                                </span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <div style="text-align: center; padding: 20px; color: #999;">
                                                        <i class="fas fa-inbox" style="font-size: 32px;"></i>
                                                        <p style="margin-top: 8px;">Không có người dùng</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div style="text-align: center; padding: 40px; color: #999;">
                                    <i class="fas fa-inbox" style="font-size: 48px;"></i>
                                    <p style="margin-top: 10px;">Không có dữ liệu</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Additional statistics row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">📈 Tổng Quan Hệ Thống</h3>
                        </div>
                        <div class="card-body">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div style="padding: 20px; background: #f0f4ff; border-radius: 8px; border-left: 4px solid #3b82f6;">
                                    <p style="margin: 0 0 10px 0; color: #64748b; font-size: 14px;">
                                        <i class="fas fa-check-circle"></i> Người Dùng Kích Hoạt
                                    </p>
                                    <h4 style="margin: 0; color: #10b981; font-size: 24px; font-weight: 700;">
                                        <?= $activeUsers ?>
                                    </h4>
                                    <p style="margin: 5px 0 0 0; color: #999; font-size: 12px;">
                                        <?= $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0 ?>% hoạt động
                                    </p>
                                </div>
                                <div style="padding: 20px; background: #fef2f2; border-radius: 8px; border-left: 4px solid #ef4444;">
                                    <p style="margin: 0 0 10px 0; color: #64748b; font-size: 14px;">
                                        <i class="fas fa-ban"></i> Người Dùng Vô Hiệu
                                    </p>
                                    <h4 style="margin: 0; color: #ef4444; font-size: 24px; font-weight: 700;">
                                        <?= $inactiveUsers ?>
                                    </h4>
                                    <p style="margin: 5px 0 0 0; color: #999; font-size: 12px;">
                                        <?= $totalUsers > 0 ? round(($inactiveUsers / $totalUsers) * 100, 1) : 0 ?>% không hoạt động
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">💰 Thông Tin Doanh Thu</h3>
                        </div>
                        <div class="card-body">
                            <div style="padding: 20px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 8px; color: white;">
                                <p style="margin: 0 0 10px 0; color: rgba(255, 255, 255, 0.8); font-size: 14px;">
                                    <i class="fas fa-coins"></i> Tổng Doanh Thu (Booking Hoàn Thành)
                                </p>
                                <h4 style="margin: 0; font-size: 28px; font-weight: 700;">
                                    <?= number_format($totalRevenue, 0, ',', '.') ?> đ
                                </h4>
                                <p style="margin: 10px 0 0 0; color: rgba(255, 255, 255, 0.8); font-size: 12px;">
                                    Từ <?= $totalBookings ?> booking
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Management Details Report -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">📋 Báo Cáo Chi Tiết Các Mục Quản Lý</h3>
                            <div class="card-tools pull-right">
                                <button type="button" class="btn btn-box-tool btn-sm" data-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                                
                                <!-- Tour Management -->
                                <div style="padding: 20px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700;">
                                            <i class="fas fa-map-marked-alt"></i> Quản Lý Tour
                                        </h4>
                                        <span style="background: rgba(255, 255, 255, 0.2); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                            <?= $totalTours ?> tour
                                        </span>
                                    </div>
                                    <p style="margin: 0 0 12px 0; font-size: 13px; color: rgba(255, 255, 255, 0.9);">Quản lý toàn bộ tour du lịch, lịch trình, giá cả và hình ảnh.</p>
                                    <a href="<?= BASE_URL . 'tour' ?>" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-right"></i> Quản lý tour
                                    </a>
                                </div>

                                <!-- Customer Management -->
                                <div style="padding: 20px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700;">
                                            <i class="fas fa-users"></i> Khách Hàng
                                        </h4>
                                        <span style="background: rgba(255, 255, 255, 0.2); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                            <?= $totalCustomers ?> khách
                                        </span>
                                    </div>
                                    <p style="margin: 0 0 12px 0; font-size: 13px; color: rgba(255, 255, 255, 0.9);">Quản lý thông tin khách hàng, lịch sử booking và phản hồi.</p>
                                    <a href="<?= BASE_URL . 'khach-hang' ?>" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-right"></i> Quản lý khách
                                    </a>
                                </div>

                                <!-- Booking Management -->
                                <div style="padding: 20px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700;">
                                            <i class="fas fa-calendar-check"></i> Booking
                                        </h4>
                                        <span style="background: rgba(255, 255, 255, 0.2); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                            <?= $totalBookings ?> booking
                                        </span>
                                    </div>
                                    <p style="margin: 0 0 12px 0; font-size: 13px; color: rgba(255, 255, 255, 0.9);">Quản lý đơn đặt tour, thanh toán, xác nhận và hủy booking.</p>
                                    <a href="<?= BASE_URL . 'booking' ?>" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-right"></i> Quản lý booking
                                    </a>
                                </div>

                                <!-- User Management -->
                                <div style="padding: 20px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700;">
                                            <i class="fas fa-user-shield"></i> Nhân Viên
                                        </h4>
                                        <span style="background: rgba(255, 255, 255, 0.2); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                            <?= $totalEmployees ?> nhân viên
                                        </span>
                                    </div>
                                    <p style="margin: 0 0 12px 0; font-size: 13px; color: rgba(255, 255, 255, 0.9);">Quản lý tài khoản nhân viên, vai trò, quyền hạn và trạng thái.</p>
                                    <a href="<?= BASE_URL . 'user' ?>" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-right"></i> Quản lý nhân viên
                                    </a>
                                </div>

                                <!-- Category Management -->
                                <div style="padding: 20px; background: linear-gradient(135deg, #ec4899, #be185d); border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700;">
                                            <i class="fas fa-list"></i> Danh Mục
                                        </h4>
                                        <span style="background: rgba(255, 255, 255, 0.2); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                            Danh mục tour
                                        </span>
                                    </div>
                                    <p style="margin: 0 0 12px 0; font-size: 13px; color: rgba(255, 255, 255, 0.9);">Quản lý phân loại tour, thêm danh mục mới và chỉnh sửa.</p>
                                    <a href="<?= BASE_URL . 'danh-muc-tour' ?>" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-right"></i> Quản lý danh mục
                                    </a>
                                </div>

                                <!-- Policy Management -->
                                <div style="padding: 20px; background: linear-gradient(135deg, #06b6d4, #0891b2); border-radius: 12px; color: white; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <h4 style="margin: 0; font-size: 16px; font-weight: 700;">
                                            <i class="fas fa-file-contract"></i> Chính Sách
                                        </h4>
                                        <span style="background: rgba(255, 255, 255, 0.2); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                            <?= $totalPolicies ?> chính sách
                                        </span>
                                    </div>
                                    <p style="margin: 0 0 12px 0; font-size: 13px; color: rgba(255, 255, 255, 0.9);">Quản lý chính sách hủy, hoàn tiền, bảo hiểm tour.</p>
                                    <a href="<?= BASE_URL . 'policy' ?>" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                        <i class="fas fa-arrow-right"></i> Quản lý chính sách
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>

<?php
$content = ob_get_clean();

// Hiển thị layout với nội dung
view('layouts.AdminLayout', [
    'title' => $title ?? 'Báo cáo thống kê - Website Quản Lý Tour',
    'pageTitle' => 'Báo cáo thống kê',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Báo cáo thống kê', 'url' => BASE_URL . 'report', 'active' => true],
    ],
]);
?>

<!-- Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Role Chart (Doughnut)
        const roleChartElement = document.getElementById('roleChart');
        if (roleChartElement) {
            const roleCtx = roleChartElement.getContext('2d');
            const roleChart = new Chart(roleCtx, {
                type: 'doughnut',
                data: {
                    labels: <?= json_encode($roleLabels) ?>,
                    datasets: [{
                        data: <?= json_encode($roleCounts) ?>,
                        backgroundColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#ef4444',
                            '#8b5cf6',
                            '#06b6d4',
                            '#ec4899',
                            '#14b8a6'
                        ],
                        borderColor: '#fff',
                        borderWidth: 3,
                        hoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 13,
                                    weight: 600
                                },
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            borderColor: '#fff',
                            borderWidth: 1,
                            displayColors: true,
                            padding: 10
                        }
                    }
                }
            });
        }

        // Status Chart (Pie)
        const statusChartElement = document.getElementById('statusChart');
        if (statusChartElement) {
            const statusCtx = statusChartElement.getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'pie',
                data: {
                    labels: [
                        'Kích Hoạt',
                        'Vô Hiệu'
                    ],
                    datasets: [{
                        data: [<?= $activeUsers ?>, <?= $inactiveUsers ?>],
                        backgroundColor: [
                            '#28a745',
                            '#dc3545'
                        ],
                        borderColor: '#fff',
                        borderWidth: 3,
                        hoverBorderWidth: 4,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 13,
                                    weight: 600
                                },
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }
    });

    // Collapse/Expand functionality
    document.querySelectorAll('[data-widget="collapse"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.card');
            const cardBody = card.querySelector('.card-body');
            
            if (cardBody) {
                cardBody.style.display = cardBody.style.display === 'none' ? 'block' : 'none';
                this.querySelector('i').classList.toggle('fa-minus');
                this.querySelector('i').classList.toggle('fa-plus');
            }
        });
    });
</script>