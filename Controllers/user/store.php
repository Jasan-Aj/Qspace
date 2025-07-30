<?php 
   
    $validator = new Validation();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    $email_res = $validator->lengthValidate($email);
    $pass_res = $validator->lengthValidate($password,8);
    $username_res = $validator->lengthValidate($username);
    
    if(!$email_res){
       $errors['body'] = "Email can't be empty!";
       require base_path('Controllers/user/register.php'); 
       exit();
    }
    elseif(!$pass_res){
        $errors['body'] = "Password must be contains 8 characters!";
        require base_path('Controllers/user/register.php'); 
        exit();
    }
    elseif(!$username_res){
        $errors['body'] = "Username can't be empty!";
        require base_path('Controllers/user/register.php'); 
        exit();
    }
    else{
        
        if($validator->emailValidation($email)){
            $errors['body'] = "Email already exist!";
            require base_path('Controllers/user/register.php');
            exit();
        }
        elseif($validator->usernameValidation($username)){
            $errors['body'] = "Username already exist!";
            require base_path('Controllers/user/register.php');
            exit();
        }
        else{
            $config = require base_path('Core/config.php');
            $db = new Database($config);
            $db->query("INSERT INTO user (email, password, username) VALUES(:email, :password, :username)",[
                'email' => $email,
                'password' => $password,
                'username' => $username,
            ]);
            header('location: login');
        }
    }

?>