<?php 

    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $username = $_SESSION['user'];
    $room_id = $_POST['room_id'];

    $res = $db->query("SELECT id FROM user WHERE username = :username ",[
        'username' => $username
    ])->fetch();

    $user_id = $res['id'];

    $db->query("INSERT INTO room_members (room_id, user_id) VALUES(:room_id, :user_id)",[
        'room_id' => $room_id,
        'user_id' => $user_id,
    ]);

    header('location: /QSPACE/myrooms');

?>