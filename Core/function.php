<?php 

    function base_path($path){
        return BASE_PATH.$path;
    }

    function abort($code = '404'){
        if($code=='404'){
            require base_path('Controllers/errors/error_404.php');
        }
        else{
            require base_path('Controllers/errors/error_404.php');
        }
    }

    function addRoute($url=''){
        return '/git/Qspace/'.$url;
    }
    
    function getHost($id){
        $config = require base_path("Core/config.php");
        $db = new Database($config);
        $host = $db->query("SELECT username from user WHERE id = :id",[
            'id' => $id
        ])->fetch();
        return $host['username'];
    }

    function getRoomMemberCount(int $id){
            
            $config = require base_path("Core/config.php");
            $db = new Database($config);
                
            $result = $db->query(
                "SELECT COUNT(*) as member_count 
                FROM room_members 
                WHERE room_id = :room_id",
                ['room_id' => $id]
            )->fetch();
                
            if (!$result || !isset($result['member_count'])) {
                return 0;
            }
            else{
                return (int) $result['member_count'];
            }
        }

        function isHaveSpace($id) {
            $config = require base_path("Core/config.php");
            $db = new Database($config);

            
            $room = $db->query("SELECT members_count FROM rooms WHERE id = :id", [
                'id' => $id
            ])->fetch();


            $total_space = (int)$room['members_count'];
            $current_users_count = getRoomMemberCount($id);

            return $current_users_count < $total_space;
        }

        function click_counter($count){
            return $count + 1;
        }
?>