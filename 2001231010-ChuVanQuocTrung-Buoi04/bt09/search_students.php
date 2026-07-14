<?php require '../bt01/connect.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bài 09 - Tìm kiếm</title>
</head>

<body class="container mt-4">
    <h2>Tìm kiếm sinh viên</h2>
    <form method="get" class="mb-3">
        <input type="text" name="keyword" class="form-control" placeholder="Nhập tên..." required>
        <button type="submit" class="btn btn-primary mt-2">Tìm kiếm</button>
    </form>

    <?php if (isset($_GET['keyword'])):
        $stmt = $conn->prepare("SELECT * FROM students WHERE name LIKE ?");
        $stmt->execute(['%' . $_GET['keyword'] . '%']);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>