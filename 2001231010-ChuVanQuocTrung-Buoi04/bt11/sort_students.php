<?php
require '../bt01/connect.php';
$sort = in_array($_GET['sort'] ?? '', ['name', 'email']) ? $_GET['sort'] : 'name';
$stmt = $conn->query("SELECT * FROM students ORDER BY $sort ASC");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bài 11 - Sắp xếp</title>
</head>

<body class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><a href="?sort=name">Họ tên (Sắp xếp)</a></th>
                <th><a href="?sort=email">Email (Sắp xếp)</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($row['name']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($row['email']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>