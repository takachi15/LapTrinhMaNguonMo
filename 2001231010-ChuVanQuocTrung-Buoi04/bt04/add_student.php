<?php
// 1. Nhúng file kết nối (hãy chú ý đường dẫn tương đối như đã trao đổi trước đó)
require '../bt01/connect.php';

// 2. Xử lý khi người dùng nhấn nút Thêm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Chuẩn bị câu lệnh SQL với Prepared Statement (dùng dấu ?)
    $sql = "INSERT INTO students (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Thực thi với dữ liệu từ form
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone']
    ]);

    echo "Thêm thành công!";
}
?>

<!-- 3. Form nhập liệu -->
<form method="post">
    <label>Họ tên:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>SĐT:</label>
    <input type="text" name="phone"><br>

    <button type="submit">Thêm</button>
</form>