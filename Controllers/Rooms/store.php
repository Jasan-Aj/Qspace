<?php 

    $name = $_POST['name'];
    $topic = $_POST['topic'];
    $count = $_POST['count'];
    $description = $_POST['description'];
    $user = $_SESSION['user'];

    $validator = new Validation();
    
    $res = $validator->roomValidation($name);

    $config = require base_path('Core/config.php');
    $db = new Database($config);

    if(!$res){
        $errors['body'] = "Room name already exist";
        require base_path('Controllers/Room/create.php');
    }
    else{
        $db->query("INSERT INTO rooms (name,topic,host,members_count,description) VALUES(:name, :topic, :host, :members_count, :description)",[
            'name' => $name,
            'topic' => $topic,
            'host' => $user,
            'members_count' => $count,
            'description' => $description,
        ]);
        header('location:/git/Qspace/rooms');
    }

?>