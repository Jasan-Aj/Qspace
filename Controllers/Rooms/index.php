<?php 

    $config = require base_path('Core/config.php');
    

    $db = new Database($config);
    $rooms = $db->query('SELECT * FROM rooms')->fetchAll();

    require base_path('Controllers/Rooms/views/index.view.php')

?>

