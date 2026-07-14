<?php
require '../bt01/connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone']]);
    echo "<div class='alert alert-success'>Thêm thành công!</div>";
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bài 10 - Thêm mới</title>
</head>

<body class="container mt-4">
    <form method="post" class="p-3 border">
        <input type="text" name="name" class="form-control mb-2" placeholder="Họ tên" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="text" name="phone" class="form-control mb-2" placeholder="SĐT">
        <button type="submit" class="btn btn-success">Lưu (Prepared Statement)</button>
    </form>
</body>

</html>