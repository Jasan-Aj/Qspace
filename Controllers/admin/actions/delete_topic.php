<?php 
    $name = $_GET['name'];
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $db->query("DELETE FROM topics WHERE name = :name",[
        'name' => ucfirst($name)
    ]);
    header('location:'.addRoute('admin_topics'));
?>