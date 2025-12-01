<?php

// Nạp cấu hình chung của ứng dụng
$config = require __DIR__ . '/config/config.php';

// Nạp các file chứa hàm trợ giúp
require_once __DIR__ . '/src/helpers/helpers.php'; // Helper chứa các hàm trợ giúp (hàm xử lý view, block, asset, session, ...)
require_once __DIR__ . '/src/helpers/database.php'; // Helper kết nối database(kết nối với cơ sở dữ liệu)

// Nạp các file chứa model
require_once __DIR__ . '/src/models/User.php';
require_once __DIR__ . '/src/models/ChinhSach.php';
require_once __DIR__ . '/src/models/Booking.php';
require_once __DIR__ . '/src/models/DanhMucTour.php';
require_once __DIR__ . '/src/models/Customer.php';

// Nạp các file chứa controller
require_once __DIR__ . '/src/controllers/HomeController.php';
require_once __DIR__ . '/src/controllers/AuthController.php';
require_once __DIR__ . '/src/controllers/ChinhSachController.php';
require_once __DIR__ . '/src/controllers/UserController.php';
require_once __DIR__ . '/src/controllers/ReportController.php';
require_once __DIR__ . '/src/controllers/CustomerController.php';
require_once __DIR__ . '/src/controllers/BookingController.php';

// Khởi tạo các controller
$homeController = new HomeController();
$authController = new AuthController();
$chinhSachController = new ChinhSachController();
$userController = new UserController();
$reportController = new ReportController();
$customerController = new CustomerController();
$bookingController = new BookingController();
// Xác định route dựa trên tham số act (mặc định là trang chủ '/')
$act = $_GET['act'] ?? '/';

// Match đảm bảo chỉ một action tương ứng được gọi
match ($act) {
    // Trang welcome (cho người chưa đăng nhập) - mặc định khi truy cập '/'
    '/', 'welcome' => $homeController->welcome(),

    // Trang home (cho người đã đăng nhập)
    'home' => $homeController->home(),

    // Đường dẫn đăng nhập, đăng xuất
    'login' => $authController->login(),
    'check-login' => $authController->checkLogin(),
    'logout' => $authController->logout(),

    // Route chính sách
    'policy' => $chinhSachController->getListPolicy(),
    'form-add-policy' => $chinhSachController->formAddPolicy(),
    'add-policy' => $chinhSachController->addPolicy(),
    'delete-policy' => $chinhSachController->deletePolicy(),
    'form-update-policy' => $chinhSachController->formUpdatePolicy(),
    'update-policy' => $chinhSachController->updatePolicy(),
    'detail-policy' => $chinhSachController->detailPolicy(),


    // Route nguoi dung
    'user' => $userController->getListUser(),
    'form-add-user' => $userController->formAddUser(),
    'add-user' => $userController->addUser(),
    'delete-user' => $userController->deleteUser(),

    // Route khách hàng
    'khach-hang' => $customerController->getList(),
    'form-add-khach-hang' => $customerController->formAdd(),
    'add-khach-hang' => $customerController->add(),
    'delete-khach-hang' => $customerController->delete(),
    'form-update-khach-hang' => $customerController->formUpdate(),
    'update-khach-hang' => $customerController->update(),
    'detail-khach-hang' => $customerController->detail(),

    // Route booking
    'booking' => $bookingController->getListBooking(),
    'detail-booking' => $bookingController->detailBooking(),

    // Route báo cáo thống kê
    'report' => $reportController->getStatistics(),
    // Đường dẫn không tồn tại
    default => $homeController->notFound(),
};
