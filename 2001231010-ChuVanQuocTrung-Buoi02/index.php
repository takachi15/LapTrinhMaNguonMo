<?php
/**
 * Tệp tin: index.php
 * Tác giả: Chu Văn Quốc Trung
 * Chức năng: Tự động quét và liệt kê danh sách các tệp tin bài tập trong project
 */

// Định nghĩa thư mục gốc cần quét (thư mục hiện tại)
$directory = __DIR__;

// Lấy danh sách tất cả các file và thư mục
$items = scandir($directory);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang Điều Hướng Project - Chu Văn Quốc Trung</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            line-height: 1.8;
            padding: 40px;
            background-color: #f4f7f6;
        }

        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 8px 0;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }

        a {
            text-decoration: none;
            color: #2980b9;
            font-weight: 500;
        }

        a:hover {
            color: #e67e22;
            text-decoration: underline;
        }

        .folder {
            font-weight: bold;
            color: #27ae60;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Danh Mục Bài Tập Project</h1>
        <ul>
            <?php
            foreach ($items as $item) {
                // Bỏ qua các file ẩn (ví dụ: .git, .vscode) và chính file index.php này
                if ($item === '.' || $item === '..' || $item === 'index.php' || strpos($item, '.') === 0) {
                    continue;
                }

                // Kiểm tra nếu là thư mục
                if (is_dir($item)) {
                    echo "<li>📁 <span class='folder'>Thư mục: $item</span>";
                    // Tìm các file .php bên trong thư mục con
                    $subItems = scandir($directory . DIRECTORY_SEPARATOR . $item);
                    echo "<ul>";
                    foreach ($subItems as $subItem) {
                        if (pathinfo($subItem, PATHINFO_EXTENSION) === 'php') {
                            echo "<li>&nbsp;&nbsp;&nbsp;&nbsp;📄 <a href='$item/$subItem'>$subItem</a></li>";
                        }
                    }
                    echo "</ul></li>";
                }
                // Kiểm tra nếu là file php ở thư mục gốc
                elseif (pathinfo($item, PATHINFO_EXTENSION) === 'php') {
                    echo "<li>📄 <a href='$item'>$item</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</body>

</html>