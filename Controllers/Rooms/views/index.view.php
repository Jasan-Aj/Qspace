<?php
    require base_path('Controllers/components/header.php');
    
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $rooms = $db->query("SELECT * FROM rooms")->fetchAll();
    $chat_bot = '/git/Qspace/assets/chat-bot.gif';

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

        <div class="home-content">
        <div class="fixed right-28 z-50">
            
            <a href="create-room" class="absolute top-[10px] left-4 bg-green-600 hover:bg-green-700 rounded-full p-4 shadow-lg transition-colors duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="sr-only">Create Room</span>
            </a>

            
            <a href="chat-bot" class="absolute top-[90px]">
                <button id="options-button" class=" w-[90px] bg-white shadow-lg rounded-full mr-[50px] transition-colors duration-200 flex items-center justify-center">
                    <img class="w-[200px]" src="/git/Qspace/assets/chat-bot.gif" alt="image">
                    <span class="sr-only">Options</span>
                </button>
            </a>
        </div>

        <?php if (empty($rooms)): ?>
            
            <div class="flex flex-col items-center justify-center h-[60vh]">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No rooms currently available</h3>
                    <p class="mt-1 text-gray-500">Be the first to create a room and start the conversation!</p>
                    <div class="mt-6">
                        <a href="create-room" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create Room
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
           
            <div class="flex flex-col gap-5 pb-16">
                <?php foreach ($rooms as $room): ?>
                    <div id="room" data-roomid = <?php echo $room['id'] ?> class="border-2 w-[80%] sm:w-[85%] md:w-[75%] lg:w-[65%] xl:w-[55%] bg-white rounded-lg ml-6 p-3 hover:shadow-md transition-shadow">
                        <a href="join-notice/?id=<?php echo $room['id'] ?>">
                            <div class="mt-1 flex justify-between px-2 text-sm text-gray-500">
                                <p><?php echo timeAgo($room['created_date']) ?></p>
                                <p><?php echo getHost($room['host']) ?></p>
                            </div>
                            <div class="mt-1 px-2 py-3 flex justify-start">
                                <p class="text-gray-800 text-lg font-semibold "><?php echo htmlspecialchars($room['name']) ?></p>
                                <p class="text-sm flex mb-2">
                                
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex flex-col gap-2 mt-2">
                                <div class="flex justify-between items-center"> 
                                    <p class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-600">
                                        <?php echo htmlspecialchars($room['topic']) ?>
                                    </p>                           
                                    <span class="text-sm font-semibold text-gray-500">
                                        <?php echo getRoomMemberCount($room['id']) ?>/<?php echo $room['members_count'] ?>
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <?php $percentage = getRoomMemberCount($room['id']) / $room['members_count'] * 100; ?>
                                    <div class="h-2.5 rounded-full bg-gradient-to-r from-blue-500 to-blue-600" 
                                         style="width: <?php echo $percentage ?>%">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</section> 
<Script>

    // $(document).ready(function(){
    //     $('[data-roomid]').click(function(){
    //         var roomid = $(this).data('roomid');
    //         $.ajax({
    //             type: 'POST',
    //             url: 'increaseViews',
    //             data: {roomid: roomid},
    //             success: function(data){
    //                 $('#view-count').html('Views: ' + data);
    //             }
    //         });
    //     });
    // });

</Script>
    <?php require base_path('Controllers/components/footer.php') ?>



