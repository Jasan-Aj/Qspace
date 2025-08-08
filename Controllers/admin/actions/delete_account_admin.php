
<?php 
    $user_id = $_GET['id'];
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $db->query("DELETE FROM user WHERE id = :id",[
        'id' => $user_id
    ]);
    header('location:'.addRoute('admin_users'));
?>