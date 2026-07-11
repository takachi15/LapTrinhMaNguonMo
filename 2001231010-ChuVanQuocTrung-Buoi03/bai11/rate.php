<?php
// URL lấy tỷ giá mới nhất của đồng USD so với các đồng tiền khác
$url = "https://api.frankfurter.app/latest?from=USD";

// Lấy dữ liệu từ API
$data = file_get_contents($url);

// Thiết lập header là JSON để JavaScript hiểu
header('Content-Type: application/json');
echo $data;
?>