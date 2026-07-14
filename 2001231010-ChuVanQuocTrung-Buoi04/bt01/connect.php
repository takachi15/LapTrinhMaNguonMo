<?php
$dsn = "mysql:host=localhost;dbname=labdb;charset=utf8";
$username = "root";
$password = "";
try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công!";
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}
