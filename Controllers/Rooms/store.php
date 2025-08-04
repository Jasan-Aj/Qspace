<?php 
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $name = $_POST['name'];
    $topic = $_POST['topic'];
    $count = $_POST['count'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $validator = new Validation();
    
    $res = $validator->roomValidation($name);

    

    if(!$res){
        $errors['body'] = "Room name already exist";
        require base_path('Controllers/Rooms/create.php');
    }
    else{
        $db->query("INSERT INTO rooms (name,topic,host,members_count,description) VALUES(:name, :topic, :host, :members_count, :description)",[
            'name' => $name,
            'topic' => $topic,
            'host' => $user_id,
            'members_count' => $count,
            'description' => $description,
        ]);
        $res = $db->query("SELECT id FROM rooms WHERE name = :name",[
            'name' => $name
        ])->fetch();
        
        $db->query("INSERT INTO room_members (room_id, user_id) VALUES(:room_id, :user_id)",[
        'room_id' => $res['id'],
        'user_id' => $user_id,
        ]);

        header('location:'.addRoute('myrooms'));
    }

?>