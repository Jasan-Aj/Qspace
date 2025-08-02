<?php 

    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $room_id = $_POST['room_id'];

    $user_id = $_SESSION['user_id'];

    $db->query("INSERT INTO room_members (room_id, user_id) VALUES(:room_id, :user_id)",[
        'room_id' => $room_id,
        'user_id' => $user_id,
    ]);

    header('location:'.addRoute('myrooms'));

?>