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

?>