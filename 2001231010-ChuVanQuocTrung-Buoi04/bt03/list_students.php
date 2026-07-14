<?php
require '../bt01/connect.php';
$stmt = $conn->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Thao tác</th>
    </tr>
    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td>
                <a href="../bt06/edit_student.php?id=<?= $row['id'] ?>" class="action-link edit-link">Sửa</a>
                |
                <a href="../bt05/delete_student.php?id=<?= $row['id'] ?>"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
                    class="action-link delete-link">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>