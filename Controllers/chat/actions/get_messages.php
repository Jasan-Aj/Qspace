<?php

$room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;

if ($room_id <= 0) {
    http_response_code(400);
    exit();
}

$config = require base_path("Core/config.php");
$db = new Database($config);

$messages = $db->query("SELECT m.*, u.username 
    FROM messages m
    JOIN user u ON m.user_id = u.id
    WHERE m.room_id = :room_id
    ORDER BY m.created_at ASC",[
        'room_id' => $room_id
    ])->fetchAll();

foreach ($messages as $message) {
    $isCurrentUser = ($message['user_id'] == $_SESSION['user_id']);
    $bgClass = $isCurrentUser ? 'bg-blue-100' : 'bg-gray-100';
    $alignClass = $isCurrentUser ? 'ml-auto' : 'mr-auto';
    
    echo '<div class="mb-4 max-w-xs '.$alignClass.'">';
    echo '<div class="'.$bgClass.' rounded-lg p-3 shadow">';
    echo '<div class="font-semibold">'.htmlspecialchars($message['username']).'</div>';
    echo '<div>'.htmlspecialchars($message['content']).'</div>';
    echo '<div class="text-xs text-gray-500 mt-1">'.date('h:i A', strtotime($message['created_at'])).'</div>';
    echo '</div>';
    echo '</div>';
}
?>