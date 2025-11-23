<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// $act = $_GET['act'] ?? '/';
// // Kiểm tra đăng nhập admin
// if($act != 'login-admin' && $act != 'check-login-admin' && $act != 'logout-admin') {
//     checkLoginAdmin();
// }

// Require toàn bộ file Controllers
require_once './controllers/ChinhSachController.php';

// Require toàn bộ file Models
require_once '../models/ChinhSach.php';
// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    //route cho trang chủ pending
    // '/' => (new BaoCaoThongKe())->home(),

    // Route chính sách
    'policy' => (new ChinhSachController())->getListPolicy(),
    'form-add-policy' => (new ChinhSachController())->formAddPolicy(),
    'add-policy' => (new ChinhSachController())->addPolicy(),
    'delete-policy' => (new ChinhSachController())->deletePolicy(),
    'form-update-policy' => (new ChinhSachController())->formUpdatePolicy(),
    'update-policy' => (new ChinhSachController())->updatePolicy(),
    'detail-policy' => (new ChinhSachController())->detailPolicy(),

};