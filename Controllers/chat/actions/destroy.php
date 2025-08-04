<?php

    $room_id = $_GET['id'];
    $config = require base_path("Core/config.php");
    $db = new Database($config);

    $db->query("DELETE FROM rooms WHERE id = :room_id",[
        'room_id' => $room_id,
    ]);

    header('location:'.addRoute('rooms'));

?>