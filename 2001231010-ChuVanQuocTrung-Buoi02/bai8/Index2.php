<?php
require_once __DIR__ . '/../autoload.php';

use App\Students\Student;

$sinhVien = new Student("Chu Văn Quốc Trung", 20, "2001231010");
echo "Họ tên: {$sinhVien->hoTen}, Mã SV: {$sinhVien->maSinhVien}";
?>