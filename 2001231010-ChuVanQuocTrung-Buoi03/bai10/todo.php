<?php
$file = 'todos.json';
// Đọc dữ liệu từ file JSON
$data = json_decode(file_get_contents($file), true) ?? [];

$action = $_POST['action'] ?? '';

if ($action === 'load') {
    // Chỉ lấy dữ liệu về
} elseif ($action === 'add') {
    $data[] = ['task' => $_POST['task'], 'done' => false];
    file_put_contents($file, json_encode($data));
} elseif ($action === 'delete') {
    array_splice($data, (int)$_POST['index'], 1);
    file_put_contents($file, json_encode($data));
} elseif ($action === 'toggle') {
    $index = (int)$_POST['index'];
    $data[$index]['done'] = !$data[$index]['done'];
    file_put_contents($file, json_encode($data));
}

header('Content-Type: application/json');
echo json_encode($data);
?>