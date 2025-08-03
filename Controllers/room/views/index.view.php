<?php
require base_path('Controllers/components/header.php');

$config = require base_path('Core/config.php');
$db = new Database($config);

$user_id = $_SESSION['user_id'];
$room_ids = $db->query("SELECT room_id FROM room_members WHERE user_id = :user_id",[
  'user_id' => $user_id
])->fetchAll();


$rooms = [];
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
        
        <div class="fixed top-15 right-6 z-50">
            <a href="rooms" class="bg-blue-600 hover:bg-blue-700 rounded-full p-4 shadow-lg transition-colors duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span class="sr-only">Explore Rooms</span>
            </a>
        </div>

        <?php if (empty($rooms)): ?>
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center h-[60vh]">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">You haven't joined any rooms yet</h3>
                    <p class="mt-1 text-gray-500">Explore and join rooms to start chatting with others!</p>
                    <div class="mt-6">
                        <a href="rooms" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Explore Rooms
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Rooms List -->
            <div class="flex flex-col gap-5 pb-16">
                <?php foreach ($rooms as $room): ?>
                        <div class="border-2 w-[80%] sm:w-[85%] md:w-[75%] lg:w-[65%] xl:w-[55%] hover:no-underline rounded-lg ml-6 bg-white p-3 hover:shadow-md transition-shadow">
                            <a href="chat/?id=<?php echo $room['id'] ?>">
                            <div class="mt-1 flex justify-between px-2 text-sm text-gray-500">
                                <p><?php echo timeAgo($room['created_date']) ?></p>
                                <p><?php echo getHost($room['host']) ?></p>
                            </div>
                            <div class="mt-1 px-2 text-lg font-semibold py-3 text-gray-800">
                                <p><?php echo htmlspecialchars($room['name']) ?></p>
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex flex-col gap-2 mt-2">
                                <div class="flex justify-between items-center"> 
                                    <p class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-600">
                                        <?php echo htmlspecialchars($room['topic']) ?>
                                    </p>                           
                                    <span class="text-sm font-semibold text-gray-500">
                                        <?php echo getRoomMemberCount($room['id']) ?>/<?php echo $room['members_count'] ?>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <?php $percentage = (getRoomMemberCount($room['id']) / $room['members_count']) * 100; ?>
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
    
    <?php require base_path('Controllers/components/footer.php') ?>
</section>