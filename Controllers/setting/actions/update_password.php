<?php 
   
    $validator = new Validation();
    $auth = new Authenticator();

    $cuurent_password = $_POST['currpassword'];
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['repassword'];
   
    $cuurent_password_res = $validator->lengthValidate($cuurent_password,8);
    $new_password_res = $validator->lengthValidate($new_password,8);
    $confirm_password_res = $validator->lengthValidate($confirm_password,8);
    
    if(!$cuurent_password_res){
       $errors['body'] = "Current password can't be empty!";
       require base_path('Controllers/setting/password.php'); 
       exit();
    }
    elseif(!$auth->auth_password($cuurent_password)){
       $errors['body'] = "Not matching current password!";
       require base_path('Controllers/setting/password.php'); 
       exit();
    }
    elseif(!$new_password_res){
       $errors['body'] = "New password must be contains 8 charectors!";
       require base_path('Controllers/setting/password.php'); 
       exit();
    }
    elseif(!$auth->auth_newpassword($new_password)){
       $errors['body'] = "New password can't be the same as the old password!";
       require base_path('Controllers/setting/password.php'); 
       exit();
    }
    elseif(!$auth->compare_password($new_password,$confirm_password)){
       $errors['body'] = "Password do not match!";
       require base_path('Controllers/setting/password.php'); 
       exit();
    }
    else{
        $config = require base_path("Core/config.php");
        $db = new Database($config);
        $db->query("UPDATE user SET password = :password WHERE id =:id",[
            'password' => password_hash(trim($new_password), PASSWORD_BCRYPT),
            'id' => $_SESSION['user_id']
        ]);
        header('location:'.addRoute('rooms'));
    }

?>