<?php

// Nạp cấu hình chung
$config = require __DIR__ . '/config/config.php';

// Nạp helpers
require_once __DIR__ . '/src/helpers/helpers.php';
require_once __DIR__ . '/src/helpers/database.php';

// Nạp model
require_once __DIR__ . '/src/models/User.php';
require_once __DIR__ . '/src/models/ChinhSach.php';


// Nạp controller
require_once __DIR__ . '/src/controllers/HomeController.php';
require_once __DIR__ . '/src/controllers/AuthController.php';
require_once __DIR__ . '/src/controllers/ChinhSachController.php';
require_once __DIR__ . '/src/controllers/BookingController.php';
require_once __DIR__ . '/src/controllers/DanhMucTourController.php';
require_once __DIR__ . '/src/controllers/CustomerController.php';
require_once __DIR__ . '/src/controllers/UserController.php';


// Khởi tạo controller
$homeController = new HomeController();
$authController = new AuthController();
$chinhSachController = new ChinhSachController();
$bookingController = new BookingController();
$danhmuctourController = new DanhMucTourController();
$customerController = new CustomerController();
$userController = new UserController();

// Xác định route dựa trên tham số act (mặc định là trang chủ '/')
$act = $_GET['act'] ?? '/';

// Router
match ($act) {

    '/', 'welcome' => $homeController->welcome(),

    'home' => $homeController->home(),

    'login' => $authController->login(),
    'check-login' => $authController->checkLogin(),
    'logout' => $authController->logout(),

    // Chính sách
    'policy' => $chinhSachController->getListPolicy(),
    'form-add-policy' => $chinhSachController->formAddPolicy(),
    'add-policy' => $chinhSachController->addPolicy(),
    'delete-policy' => $chinhSachController->deletePolicy(),
    'form-update-policy' => $chinhSachController->formUpdatePolicy(),
    'update-policy' => $chinhSachController->updatePolicy(),
    'detail-policy' => $chinhSachController->detailPolicy(),

    // Route danh mục tour
    'danh-muc-tour'         => $danhmuctourController->getList(),
    'form-add-danh-muc-tour' => $danhmuctourController->formAdd(),
    'add-danh-muc-tour'      => $danhmuctourController->add(),
    'delete-danh-muc-tour'   => $danhmuctourController->delete(),
    'form-update-danh-muc-tour' => $danhmuctourController->formUpdate(),
    'update-danh-muc-tour'   => $danhmuctourController->update(),
    'detail-danh-muc-tour'   => $danhmuctourController->detail(),

    // Route khách hàng
    'khach-hang'         => $customerController->getList(),
    'form-add-khach-hang' => $customerController->formAdd(),
    'add-khach-hang'      => $customerController->add(),
    'delete-khach-hang'   => $customerController->delete(),
    'form-update-khach-hang' => $customerController->formUpdate(),
    'update-khach-hang'   => $customerController->update(),
    'detail-khach-hang'   => $customerController->detail(),


    // Route nguoi dung
    'user' => $userController->getListUser(),
    'form-add-user' => $userController->formAddUser(),
    'form-update-user' => $userController->formUpdateUser(),
    'add-user' => $userController->addUser(),
    'update-user' => $userController->updateUser(),
    'delete-user' => $userController->deleteUser(),

    // đường dẫn cho HDV
    'home' => $homeController->home(),
    'hdv/booking' => $bookingController->getListBooking(),
    'detail-booking' => $bookingController->detailBooking(),
    'check-in' => $bookingController->checkInCustomer(),
    'update-checkin' => $bookingController->updateCheckin(),
    'update-booking-hdv-form' => $bookingController->updateHDVBookingForm(),
    'update-booking-hdv' => $bookingController->updateBookingHDV(),

    // Đường dẫn không tồn tại
    default => $homeController->notFound(),
};
