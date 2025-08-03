<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}


$room_id = isset($_POST['room_id']) ? (int)$_POST['room_id'] : 0;
$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$content = isset($_POST['content']) ? trim($_POST['content']) : '';

if ($room_id <= 0 || $user_id <= 0 || empty($content)) {
    http_response_code(400);
    echo "Invalid input";
    exit();
}

$config = require base_path("Core/config.php");
$db = new Database($config);

$db->query('INSERT INTO messages (room_id, user_id, content) VALUES (:room_id, :user_id, :content)',[
    'room_id' => $room_id,
    'user_id' => $user_id,
    'content' => $content,
]);

echo "Message sent";
?>