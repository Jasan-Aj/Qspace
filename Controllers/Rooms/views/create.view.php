
<?php 
    include base_path('Controllers/components/header.php');
    include base_path('Controllers/components/sidebar.php');
    $config = require base_path('Core/config.php');
    
    $db = new Database($config);
    $topics = $db->query('SELECT name FROM topics')->fetchAll();
    
    
?>

<section class="home-section">
    <?php require base_path('Controllers/components/nav_without_search.php') ?>
    <div class="home-content">
        <main class=" flex items-center justify-center">
            <div class="w-full max-w-md items-center mt-10">
                <div class="bg-white rounded-xl shadow-xl p-6 sm:p-8">
                    <div class="text-center mb-3 ">
                        <h2 class="text-2xl font-bold text-gray-800">Create Room</h2>
                        
                    </div>
                    
                    <form class="space-y-4" method="post" action="<?php echo addRoute('store') ?>" >
                        <!-- Name Input -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name for your room</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                placeholder="John Doe" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                                required
                                value="<?php echo isset($errors['body']) ? $_POST['name'] : '' ?>"
                            >
                            <p class="text-sm text-red-500"><?php echo !empty($errors) ?  $errors['body'] : '' ?></p>
                        </div>
                        
                        <!-- Topic Dropdown -->
                        <div>
                            <label for="topic" class="block text-sm font-medium text-gray-700 mb-1">Select Topic</label>
                            <select 
                                id="topic" 
                                name="topic" 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200 appearance-none bg-white"
                                required
                                value="<?php echo isset($errors['body']) ? $_POST['topic'] : '' ?>"
                            >
                                <option value="" disabled selected>Choose a topic</option>
                                <?php foreach($topics as $i): ?>
                                    <option value="<?php echo $i['name'] ?>"><?php echo $i['name'] ?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                        
                        <!-- Number Input -->
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700 mb-1">Room size</label>
                            <input 
                                type="number" 
                                id="number" 
                                name="count" 
                                min="1" 
                                max="100"
                                require 
                                placeholder="1" 
                                value="<?php echo isset($errors['body']) ? $_POST['count'] : '' ?>"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                            >
                        </div>
                        
                        <!-- Description Textarea -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4" 
                                placeholder="Tell us more about your inquiry..." 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                                value="<?php echo isset($errors['body']) ? $_POST['description'] : ' ' ?>"
                            ></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <div>
                            <button 
                                type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            >
                                Submit Form
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</section>



<?php include base_path('Controllers/components/footer.php') ?>


