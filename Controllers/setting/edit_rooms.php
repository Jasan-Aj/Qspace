<?php 
    require base_path("Controllers/components/setting_header.php");
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $rooms = $db->query("SELECT * FROM rooms WHERE host = :id",[
        'id' => $_SESSION['user_id']
    ])->fetchAll();

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
<body class="bg-gray-50">
    
    <?php require base_path("Controllers/components/setting_sidebar.php") ?>
        <!-- Scrollable Profile Content -->
        <div class="flex-1 ml-64 overflow-y-auto scrollable-profile h-full">
            <div class="bg-gray-100 p-6 md:p-12">
                <div class="w-full max-w-2xl mx-auto">
                    <!-- Account Section -->
                    <div class="flex w-full flex-col items-start gap-6 mb-12">
                        <div class="flex w-full flex-col items-start gap-1">
                            <h1 class="w-full text-3xl font-bold text-default-font">
                                Edit Rooms
                            </h1>
                            
                            <p class="w-full text-gray-600">
                                Update your rooms here
                            </p>
                        </div>

                        <!-- Profile Section -->
                        
                        <div class="w-full">
                            <?php foreach ($rooms as $room):?>

                                <div class="border-2  bg-white rounded-lg mt-6 p-3">
                                    
                                    <div class=" mt-1 flex justify-between px-2 text-sm">
                                        <p><?php echo timeAgo($room['created_date']) ?></p>
                                        <div>
                                            <a href="delete_room\?id=<?php echo $room['id'] ?>"  onclick="return confirmNavigation(this)" class="py-2 px-3 bg-red-500 text-white border-none rounded-lg font-semibold mr-2">Delete</a>
                                            <a href="edit_room\?id=<?php echo $room['id'] ?>" class="py-2 px-3 bg-blue-500 text-white border-none rounded-lg font-semibold">Edit room</a>
                                        </div>
                                    </div>
                                    <div class=" px-2 text-lg font-semibold py-3">
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
                                    
                                </div>
                                
                            <?php endforeach ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
            function confirmNavigation(link) {
           
            const confirmed = confirm('Are you sure?');
            
            if (!confirmed) {
                return false;
            }
            
            
            return true;
            }
    </script>
</body>
</html>