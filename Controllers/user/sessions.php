<?php 
   
    $validator = new Validation();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_res = $validator->lengthValidate($email);
    $pass_res = $validator->lengthValidate($password,8);
    
    if(!$email_res){
       $errors['body'] = "Email can't be empty!";
       require base_path('Controllers/user/login.php'); 
       exit();
    }
    elseif(!$pass_res){
        $errors['body'] = "Password must be contains 8 characters!";
        require base_path('Controllers/user/login.php'); 
        exit();
    }
    else{
        require base_path("Core/Authenticator.php");
        $auth = new Authenticator();
        $res = $auth->authenticate($email, $password);

        if($res){
            $errors['body'] = $res;
            require base_path('Controllers/user/login.php');
            exit();
        }
        else{
            $config = require base_path('Core/config.php');
            $db = new Database($config);
            $user = $db->query("SELECT username FROM user WHERE email = :email",[
                'email' => $email
            ])->fetch();
            $_SESSION['user'] = $user['username'];
            header('location:rooms');
        }
    }

?>