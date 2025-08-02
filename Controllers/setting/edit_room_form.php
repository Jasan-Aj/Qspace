<?php


    require base_path("Controllers/components/setting_header.php");
    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $res = $db->query("SELECT * FROM rooms WHERE id = :id",[
        'id' => $id
    ])->fetchAll();
    $details = $res[0];
    $topics = $db->query('SELECT name FROM topics')->fetchAll();
    
?>
<body class="bg-gray-50">
    
    <?php require base_path("Controllers/components/setting_sidebar.php") ?>
        <!-- Scrollable Profile Content -->
        <div class="flex-1 ml-64 overflow-y-auto scrollable-profile h-full">
            <div class="bg-gray-100 p-6 md:p-12">
                <div class="w-full max-w-2xl mx-auto">
                    <!-- Account Section -->
                    <div class="flex w-full flex-col items-start gap-6 mb-12">
                        
                        <div class="w-full max-w-md items-center mt-10">
                            <div class="bg-white rounded-xl shadow-xl p-6 sm:p-8">
                                <div class="text-center mb-3 ">
                                    <h2 class="text-2xl font-bold text-gray-800">Update Room</h2>
                                    
                                </div>
                                
                                <form class="space-y-4" method="post" action="<?php echo addRoute('update_room') ?>" >
                                    <input type="hidden" value="PATCH" name="__method">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
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
                                            value="<?php echo isset($errors['body']) ? $_POST['name'] : $details['name'] ?>"
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
                                            <?php foreach($topics as $i): ?>
                                               <option <?php echo $i['name'] == $details['topic'] ? 'selected': '' ?> value="<?php echo $i['name'] ?>"><?php echo $i['name'] ?></option>
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
                                            value="<?php echo isset($errors['body']) ? $_POST['count'] : $details['members_count'] ?>"
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
                                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200"
                                            
                                        ><?php echo isset($errors['body']) ? $_POST['description'] : $details['description'] ?></textarea>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>