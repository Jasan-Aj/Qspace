<?php
    require base_path('Controllers/components/header.php');
    
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $users = $db->query("SELECT * FROM user")->fetchAll();
    $default_dp = "pic.png"

?>

<?php require base_path('Controllers/components/sidebar.php') ?>

<section class="home-section">
        <?php require base_path('Controllers/components/navbar.php') ?>

        <div class="home-content">
       

        <?php if (empty($users)): ?>
            
            <div class="flex flex-col items-center justify-center h-[60vh]">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No Users currently available</h3>
                    <p class="mt-1 text-gray-500">Be the first to start the conversation!</p>
                    <div class="mt-6">
                        <a class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            
         <div class="flex flex-row flex-wrap gap-4 md:justify-start justify-center  pb-16">
                <?php foreach($users as $user): ?>
                    <div class="grid grid-rows-[60%_20%_20%] w-[250px] bg-white rounded-lg mx-2 shadow-lg">
                        <div class="px-9 pt-5 bg-gray-200 m-2  rounded-lg">
                            <img src="assets/uploads/<?php echo $user['profile_pic'] ? $user['profile_pic'] : $default_dp ?>" class="w-[160px] rounded" alt="img">
                        </div>
                        <div class="p-3 flex flex-col gap-1">
                            <div class="flex">
                                <span class="font-semibold">Username:</span><p class="truncate pl-1 w-23"><?php echo $user['username'] ?></p>
                            </div>
                            
                            <div class="flex">
                                <span class="font-semibold">Email:</span><p class="truncate pl-1 w-23"><?php echo $user['email'] ?></p>
                            </div>

                            <p><span class="font-semibold">Role:</span>  <?php echo $user['role'] ?></p>
                            <hr class="mt-1">
                        </div>
                        <div class="flex justify-center items-center mt-5 mb-2 ">
                            <a href="admin_delete_user/?id=<?php echo $user['id'] ?>" class="rounded-lg text-white mt-3 bg-red-500 font-semibold px-3 py-2 mt-2" onclick="return confirmNavigation(this)" >Delete</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</section> 
    <script>
            function confirmNavigation(link) {
           
            const confirmed = confirm('Are you sure?');
            
            if (!confirmed) {
                return false;
            }
            
            
            return true;
            }
    </script>

    <?php require base_path('Controllers/components/footer.php') ?>



