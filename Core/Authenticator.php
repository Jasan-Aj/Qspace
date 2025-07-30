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
                if($password == $user['password']){
                    return null;
                }
                else{
                    return "Incorrect Password";
                }
            }
        }

    }

?>