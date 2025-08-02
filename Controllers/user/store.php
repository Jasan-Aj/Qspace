<?php 
   
    $validator = new Validation();

    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $upload_dir = base_path("assets/uploads/");
    $file_name = null;

    if ($_FILES['image']['error'] == 0) {
        $file_name = basename($_FILES['image']['name']);
        $file_path = $upload_dir . $file_name;
    }

    

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

            if($file_name){
                if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {

                $db->query("INSERT INTO user (email, password, username, profile_pic) VALUES(:email, :password, :username, :profile_pic)",[
                    'email' => $email,
                    'password' => password_hash(trim($password), PASSWORD_BCRYPT),
                    'username' => $username,
                    'profile_pic' => $file_name,
                ]);
                header('location:'.addRoute('login'));
    
                } 
                else {
                    $errors['body'] = "Error in moving file!";
                    require base_path('Controllers/user/register.php');
                    exit();
                }
            
            }
            else{
               $db->query("INSERT INTO user (email, password, username) VALUES(:email, :password, :username)",[
                    'email' => $email,
                    'password' => password_hash(trim($password), PASSWORD_BCRYPT),
                    'username' => $username,
                    
                ]);
                header('location:'.addRoute('login'));
                

            }
        }
    }

?>