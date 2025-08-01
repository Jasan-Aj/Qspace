<?php
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $res = $db->query("SELECT id FROM user WHERE username = :username",[
      'username' => $_SESSION['user']
    ])->fetch();
    $id = $res['id'];

    $res = $db->query("SELECT * FROM user WHERE id=:id",[
        'id' => $id
    ])->fetchAll();
    $current_details = $res[0];

    $username = $_POST['username'];
    $email = $_POST['email'];
    $upload_dir = base_path("assets/uploads/");

    $validator = new Validation();

    if ($_FILES['image']['error'] == 0) {
        $file_name = basename($_FILES['image']['name']);
        $file_path = $upload_dir . $file_name;
    }

    else {
        $file_name = null;
    }

    if($username == $current_details['username'] && $email == $current_details['email'] && !$file_name){
        $errors['body'] = "No changes made!";
        require base_path('Controllers/setting/profile.php');
        exit();
    }

    elseif($email == $current_details['email'] && $username == $current_details['username'] && $file_name ){
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {

        $db->query("UPDATE user SET email = :email, username = :username, profile_pic = :profile_pic WHERE id = :id",[
            'email' => $email,
            'username' => $username,
            'profile_pic' => $file_name,
            'id' => $id,
        ]);
        $_SESSION['user'] = $username;
        header('location:'.addRoute('rooms'));
                
        } 
        else{
            $errors['body'] = "Error in moving file!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }                
    }

    elseif($username == $current_details['username']){
        
        $email_res = $validator->lengthValidate($email);

        if(!$email_res){
            $errors['body'] = "Email can't be empty!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }

        elseif($validator->emailValidation($email)){
            $errors['body'] = "Email already exist!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }
        
        elseif($file_name){
                if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {

                $db->query("UPDATE user SET email = :email, username = :username, profile_pic = :profile_pic WHERE id = :id",[
                    'email' => $email,
                    'username' => $username,
                    'profile_pic' => $file_name,
                    'id' => $id,
                ]);
                header('location:'.addRoute('rooms'));
                
    
                } 
                else {
                    $errors['body'] = "Error in moving file!";
                    require base_path('Controllers/setting/profile.php');
                    exit();
                }
            }
            else{
                $db->query("UPDATE user SET email = :email, username = :username WHERE id = :id",[
                    'email' => $email,
                    'username' => $username,
                    'id' => $id,
                ]);
                header('location:'.addRoute('rooms'));
                
            }
    }

    elseif($email == $current_details['email']){
        
        $username_res = $validator->lengthValidate($username);
        
        if(!$username_res){
            $errors['body'] = "Username can't be empty!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }
        
        elseif($validator->usernameValidation($username)){
            $errors['body'] = "Username already exist!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }

        elseif($file_name){
                if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {

                $db->query("UPDATE user SET email = :email, username = :username, profile_pic = :profile_pic WHERE id = :id",[
                    'email' => $email,
                    'username' => $username,
                    'profile_pic' => $file_name,
                    'id' => $id,
                ]);
                $_SESSION['user'] = $username;
                header('location:'.addRoute('rooms'));
                
    
                } 
                else {
                    $errors['body'] = "Error in moving file!";
                    require base_path('Controllers/setting/profile.php');
                    exit();
                }
            }
            else{
                $db->query("UPDATE user SET email = :email, username = :username WHERE id = :id",[
                    'email' => $email,
                    'username' => $username,
                    'id' => $id,
                ]);
                $_SESSION['user'] = $username;
                header('location:'.addRoute('rooms'));
                
            }
    }


    else{
        $username_res = $validator->lengthValidate($username);
        $email_res = $validator->lengthValidate($email);

        if(!$username_res){
            $errors['body'] = "Username can't be empty!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }

        elseif(!$email_res){
            $errors['body'] = "Email can't be empty!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }

        elseif($validator->usernameValidation($username)){
            $errors['body'] = "Username already exist!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }
        elseif($validator->emailValidation($email)){
            $errors['body'] = "Email already exist!";
            require base_path('Controllers/setting/profile.php');
            exit();
        }
        else{

            if($file_name){
                if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {

                    $db->query("UPDATE user SET email = :email, username = :username, profile_pic = :profile_pic WHERE id = :id",[
                        'email' => $email,
                        'username' => $username,
                        'profile_pic' => $file_name,
                        'id' => $id,
                    ]);
                    $_SESSION['user'] = $username;
                    header('location:'.addRoute('rooms'));
                    
        
                    } 
                else {
                    $errors['body'] = "Error in moving file!";
                    require base_path('Controllers/setting/profile.php');
                    exit();
                }
            }
            else{
                    $db->query("UPDATE user SET email = :email, username = :username WHERE id = :id",[
                        'email' => $email,
                        'username' => $username,
                        'id' => $id,
                    ]);
                    $_SESSION['user'] = $username;
                    header('location:'.addRoute('rooms'));
                    
            }
                
        }
        
    }

    

?>