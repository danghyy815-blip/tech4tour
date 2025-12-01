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


// Khởi tạo controller
$homeController = new HomeController();
$authController = new AuthController();
$chinhSachController = new ChinhSachController();


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



