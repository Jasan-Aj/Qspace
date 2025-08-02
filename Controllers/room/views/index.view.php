<?php

    require base_path('Controllers/components/header.php');

    
    $config = require base_path('Core/config.php');
    $db = new Database($config);
    ;
    
    $user_id = $_SESSION['user_id'];
    $room_ids = $db->query("SELECT room_id FROM room_members WHERE user_id = :user_id",[
      'user_id' => $user_id
    ])->fetchAll();

    $rooms;
    foreach($room_ids as $id){
      $res = $db->query("SELECT * FROM rooms WHERE id = :id",[
        'id' => $id['room_id']
      ])->fetchAll();
      $rooms[] = $res[0];
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

    <div class="home-content">
        <div class="flex flex-col gap-5">
            <?php if(!empty($rooms)): ?>
            <?php foreach ($rooms as $room):?>
                <a href="chat/?id=<?php echo $room['id'] ?>"><div class="border-2 w-[80%] sm:w-[85%] md:w-[75%] lg:w-[65%] xl:w-[55%] rounded-lg ml-6 bg-white p-3">
                    <div class=" mt-1 flex justify-between px-2 text-sm">
                        <p><?php echo timeAgo($room['created_date']) ?></p>
                        <p><?php echo getHost($room['host']) ?></p>
                    </div>
                    <div class="mt-1 px-2 text-lg font-semibold py-3">
                        <p><?php echo $room['name'] ?></p>
                    </div>
                    <hr>
                    <div class="flex flex-col gap-2 mt-2">
                        <div class="flex justify-between items-center"> 
                        <p class="bg-gray-200 px-2 py-1 rounded-xl text-sm"><?php echo $room['topic'] ?></p>                           
                        <span class="text-sm font-semibold">24/50</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full bg-gradient-to-r from-blue-500 to-blue-600" style="width: 48%"></div>
                        </div>
                    </div>
                </div></a>
            <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    

    
<?php require base_path('Controllers/components/footer.php') ?>
