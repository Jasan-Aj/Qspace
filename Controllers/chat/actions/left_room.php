<?php 

    $room_id = $_GET['id'];
    $config = require base_path("Core/config.php");
    $db = new Database($config);

    $db->query("DELETE FROM room_members WHERE room_id = :room_id and user_id = :user_id",[
        'room_id' => $room_id,
        'user_id' => $_SESSION['user_id'],
    ]);

    header('location:'.addRoute('rooms'));

?>