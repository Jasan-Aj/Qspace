<?php 

    class Authenticator{
        
        public function authenticate($email, $password){
            
            $config = require base_path('Core/config.php');

            $db = new Database($config);
            $user = $db->query("SELECT email,password FROM user where email = :email",[
                'email' => $email
            ])->fetch();

            if(!$user){
                return "Not matching email found!";
            }
            else{
                if(password_verify(trim($password), $user['password'])){
                    return null;
                }
                else{
                    return "Incorrect Password";
                   
                }
            }
        }

       public function auth_password($password){
            $config = require base_path('Core/config.php');
            $db = new Database($config);

            $stored_password = $db->query("SELECT password FROM user WHERE id = :id",[
                'id' => $_SESSION['user_id']
            ])->fetch();
            
            if(password_verify(trim($password),$stored_password['password'])){
                return true;
            }
            else{
                return false;
            }
            
       } 

       public function auth_newpassword($password){
            $config = require base_path('Core/config.php');
            $db = new Database($config);

            $old_password = $db->query("SELECT password FROM user WHERE id = :id",[
                'id' => $_SESSION['user_id']
            ])->fetch();

            if(password_verify(trim($password), $old_password['password'])){
                return false;
            }
            else{
                return true;
            }
       }

       public function compare_password($password1, $password2){
            if($password1 != $password2){
                return false;
            }
            else{
                return true;
            }
       }

    }

?>