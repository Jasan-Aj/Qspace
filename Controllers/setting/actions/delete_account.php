
<?php 

    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $db->query("DELETE FROM user WHERE id = :id",[
        'id' => $_SESSION['user_id']
    ]);
    $_SESSION=[];
    session_destroy();
    header('location:'.addRoute(''));
?>