<?php 

    $room_id = $_POST['roomid'];
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $res = $db->query("SELECT views FROM rooms WHERE id =:id",[
        'id' => $room_id
    ])->fetch();

    $count = $res['views'] + 1;

    $db->query("UPDATE rooms SET views = :count WHERE id = :id",[
        'count' => $count,
        'id' => $room_id
    ]);

?>