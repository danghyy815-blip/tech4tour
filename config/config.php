<?php

// Định nghĩa các hằng số toàn cục dùng trong dự án (chỉ define nếu chưa được định nghĩa)
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__)); // Đường dẫn tuyệt đối tới thư mục gốc của dự án
}
if (!defined('BASE_URL')) {
    define('BASE_URL', '/tech4tour/'); // URL cơ bản của dự án(Lưu ý cấp độ trong htdocs hoặc www)
}

if (!defined('BASE_URL_HDV')) {
    define('BASE_URL_HDV', '/tech4tour/hdv/'); // URL cơ bản của dự án(Lưu ý cấp độ trong htdocs hoặc www)
}

// Cấu hình cơ bản cho kết nối CSDL
return [
    'db' => [
        'host' => 'localhost', // Host cơ sở dữ liệu
        'name' => 'du_lich', // Tên cơ sở dữ liệu
        'user' => 'root', // Tên người dùng
        'pass' => '', // Mật khẩu
        'charset' => 'utf8mb4', // Mã hóa
    ],
];
