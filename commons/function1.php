<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

//Thêm file
function uploadFile($file, $folderUpload)
{
    $pathStorage =$folderUpload . time() . $file['name'];
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    } else {
        return false;
    }

}

//Xóa file
function deleteFile($filePath)
{
    $path = PATH_ROOT . $filePath;
    if (file_exists($path)) {
        unlink($path);
    }
}

function formatDate($date)
{
    if ($date) {
        return date('d/m/Y', strtotime($date));
    }
    return '';
}

function checkLoginAdmin()
{
    if (!isset($_SESSION['user_admin'])) {
        header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
        exit();
    }
}

function formatPrice($price)
{
    if ($price) {
        return number_format($price, 0, ',', '.') . ' VNĐ';
    }
    return '';
}