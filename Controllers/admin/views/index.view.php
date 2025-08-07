<?php
    require base_path('Controllers/components/header.php');
    
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $rooms = $db->query("SELECT * FROM rooms")->fetchAll();

    if(isset($_SESSION['user_id'])){
        
        $unjoined_room_ids = $db->query("
            SELECT r.id 
            FROM rooms r
            LEFT JOIN room_members rm ON r.id = rm.room_id AND rm.user_id = :user_id
            WHERE rm.room_id IS NULL
        ", [
            'user_id' => $_SESSION['user_id']
        ])->fetchAll();

        $rooms = [];

        foreach($unjoined_room_ids as $id){
            $room = $db->query("SELECT * FROM rooms WHERE id =  :id",[
                'id' => $id['id']
            ])->fetchAll();
            $rooms[] = $room[0];
        }        
    }


    function timeAgo($date){
        $currentDate = time();
        $diff = $currentDate - strtotime($date);

        $intervals = [
            'year' => 3153600,
            'month' => 2592000,
            'week' => 604800,
            'day' => 86400,
            'hour' => 3600,
            'minute' => 60,
            'second' => 1,
        ];
        
        foreach($intervals as $unit => $interval){
            if($diff >= $interval){
                $value = floor($diff / $interval);
                return $value.' '.$unit.($value > 1 ? 's' : '')." ago";
            }
        }

        return 'just now';

        }
    
?>

<?php require base_path('Controllers/components/sidebar.php') ?>

<section class="home-section">
        <?php require base_path('Controllers/components/navbar.php') ?>
</section> 
    

    <?php require base_path('Controllers/components/footer.php') ?>



