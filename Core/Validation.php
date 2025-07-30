<?php
    class Validation{

        public function roomValidation($name){
            
            $config = require base_path('Core/config.php');
            $db = new Database($config);

            $state = true;
            $rooms = $db->query("SELECT * FROM rooms")->fetchAll();

            foreach($rooms as $room){
                if($room['name']==$name){
                    $state = false;
                }
            }

            return $state; 

        }

        public function lengthValidate($value, $min=1, $max=INF){
            if(strlen(trim($value)) < $min ){
                return false;
            }

            elseif(strlen(trim($value)) > $max ){
                return false;
            }

            else{
                return true;
            }
        }

        public function usernameValidation($username){
            $config = require base_path('Core/config.php');
            $db = new Database($config);

            $res = $db->query("SELECT username FROM user WHERE username = :username",[
                'username' => $username
            ])->fetch();

            if($res){
                return true;
            }
            else{
                return false;
            }
        }

        public function emailValidation($email){
            $config = require base_path('Core/config.php');
            $db = new Database($config);

            $res = $db->query("SELECT email FROM user WHERE email = :email",[
                'email' => $email
            ])->fetch();

            if($res){
                return true;
            }
            else{
                return false;
            }
        }

    }
?>