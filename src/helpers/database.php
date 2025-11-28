<?php

// Helper to get PDO from config/config.php (which returns an array)
$config = require __DIR__ . '/../../config/config.php';
$db = $config['db'];

$dsn = "mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}";
try {
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // In dev show error, in prod log and show generic message
    die('DB connection failed: ' . $e->getMessage());
}

function getDB()
{
    global $pdo;
    return $pdo;
}

