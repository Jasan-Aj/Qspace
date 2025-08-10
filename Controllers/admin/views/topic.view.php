<?php
    require base_path('Controllers/components/header.php');
    
    $config = require base_path('Core/config.php');
    $db = new Database($config);

    $topics = $db->query("SELECT * FROM topics")->fetchAll();
    

?>

<?php require base_path('Controllers/components/sidebar.php') ?>

<section class="home-section">
    <?php require base_path('Controllers/components/nav_without_search.php') ?>

    <div class="home-content flex flex-row items-center h-[90vh]">
        <main class="grid grid-cols-[50%_50%] w-full">
            <div class="w-full ml-2 flex justify-center items-center ">
                <div class="bg-white rounded-xl shadow-xl p-6 sm:p-8">
                    <div class="text-center mb-3 ">
                        <h2 class="text-2xl font-bold text-gray-800">Add new topic</h2>
                        
                    </div>
                    
                    <form class="space-y-4" method="post" action="<?php echo addRoute('add_topic') ?>" >
                        <input type="hidden" value="PUT" name="__method">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name for new topic</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                placeholder="Python" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                                value="<?php echo isset($errors['body']) ? $_POST['name'] : '' ?>"
                            >
                            <p class="text-sm text-red-500"><?php echo !empty($errors) ?  $errors['body'] : '' ?></p>
                        </div>
                        
                        
                        <!-- Submit Button -->
                        <div>
                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Add Topic
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class=" pl-5">
                <h3 class=" font-semibold text-xl">Topics</h3>
                <?php foreach($topics as $topic): ?>
                    <div class="pl-4 pt-4 bg-white p-2 flex justify-between my-3 w-[50%] rounded-lg shadow-lg ">
                        <p class="font-semibold text-lg">#  <?php echo $topic['name'] ?></p>
                        <a href="delete_topic/?name=<?php echo $topic['name'] ?>"  onclick="return confirmNavigation(this)" class="bg-red-500 text-sm text-white rounded-lg p-2">Delete</a>
                    </div>
                <?php endforeach ?>
            </div>
        </main>   

        
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



