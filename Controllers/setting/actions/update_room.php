<?php 
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $name = $_POST['name'];
    $topic = $_POST['topic'];
    $count = $_POST['count'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    $id = $_POST['id'];

    $validator = new Validation();
    
    $res = $validator->roomValidation($name);


    if(!$res){
        $errors['body'] = "Room name already exist";
        require base_path('Controllers/setting/edit_room_form.php');
    }
    else{
        $db->query("UPDATE rooms SET name = :name, topic= :topic, host = :host, members_count = :members_count, description = :description WHERE id = :id",[
            'name' => $name,
            'topic' => $topic,
            'host' => $user_id,
            'members_count' => $count,
            'description' => $description,
            'id' => $id,
        ]);
        if(getUser($_SESSION['user_id']) == 'admin'){
            header('location:'.addRoute('admin'));
        }
        else{
            header('location:'.addRoute('edit_rooms'));
        }
    }

?>