<?php
// autoload.php
spl_autoload_register(function ($class) {
    // Chuyển Namespace (ví dụ: App\Models\User) thành đường dẫn (App/Models/User.php)
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Đường dẫn tuyệt đối từ thư mục gốc
    $file = __DIR__ . DIRECTORY_SEPARATOR . $path;

    if (file_exists($file)) {
        require_once $file;
    }
});