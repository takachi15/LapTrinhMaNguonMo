<ul class="lab-list">
    <?php
    // Quét tất cả các thư mục con trong project
    $directories = glob('*', GLOB_ONLYDIR);
    
    // Sắp xếp các thư mục theo số thứ tự trong tên
    usort($directories, function($a, $b) {
        // Lấy số từ tên thư mục (ví dụ: 'bai12' -> 12)
        $numA = (int)preg_replace('/[^0-9]/', '', $a);
        $numB = (int)preg_replace('/[^0-9]/', '', $b);
        return $numA <=> $numB;
    });

    foreach ($directories as $dir) {
        // Chỉ duyệt các thư mục có tên bắt đầu bằng 'bai' hoặc 'lab'
        if (preg_match('/^(bai|lab)/i', $dir)) {
            
            $targetFile = '';
            
            // 1. Ưu tiên tìm file index trước
            if (file_exists($dir . '/index.html')) {
                $targetFile = $dir . '/index.html';
            } elseif (file_exists($dir . '/index.php')) {
                $targetFile = $dir . '/index.php';
            } else {
                // 2. Nếu không có file index, tìm bất kỳ file .html hoặc .php nào khác
                $allFiles = glob($dir . '/*.{html,php}', GLOB_BRACE);
                if (!empty($allFiles)) {
                    $targetFile = $allFiles[0]; // Lấy file đầu tiên tìm được
                }
            }

            // 3. Nếu tìm thấy file, hiển thị link
            if ($targetFile) {
                echo "<li>📁 <a href='$targetFile'>Truy cập: " . ucfirst($dir) . "</a></li>";
            }
        }
    }
    ?>
</ul>