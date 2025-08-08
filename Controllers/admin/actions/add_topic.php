<?php 
    $name = $_POST['name'];
    $validator  = new Validation();
    $res = $validator->lengthValidate($name,1,15);
    $user = "admin";

    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $alredy = $db->query("SELECT name FROM topics WHERE name = :name",[
        'name' => ucfirst($name)
    ])->fetch();

    if(!$res){
        $errors['body'] = "Enter valid length of charecters";
        require base_path("Controllers/admin/topic.php");
    }
    elseif($alredy){
        $errors['body'] = "The name of topic is alredy exist";
        require base_path("Controllers/admin/topic.php");
    }
    else{

        $db->query("INSERT INTO topics (name, created_by) VALUES(:name, :created_by)",[
            'name' => ucfirst($name),
            'created_by' => $user,
        ]);
        header('location:'.addRoute('admin_topics'));
    }
    
?>