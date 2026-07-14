<?php
require '../bt01/connect.php';


?>



<!-- Bảng hiển thị có sắp xếp -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Họ tên</a></th>
        <th>Email</a></th>
        <th>SĐT</th>
        <th>Ngày sinh</th> <!-- Bài 08 -->
        <th>Thao tác</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td>
                <?= $row['id'] ?>
            </td>
            <td>
                <?= $row['name'] ?>
            </td>
            <td>
                <?= $row['email'] ?>
            </td>
            <td>
                <?= $row['phone'] ?>
            </td>
            <td>
                <?= $row['birthday'] ?? 'Chưa cập nhật' ?>
            </td>
            <td>
                <a href="../bt05/edit_student.php?id=<?= $row['id'] ?>">Sửa</a> |
                <a href="../bt05/delete_student.php?id=<?= $row['id'] ?>">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>