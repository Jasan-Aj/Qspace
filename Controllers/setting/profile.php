<?php 
    require base_path("Controllers/components/setting_header.php");

    $config = require base_path("Core/config.php");
    $db = new Database($config);
    $res = $db->query("SELECT id FROM user WHERE username = :username",[
      'username' => $_SESSION['user']
    ])->fetch();
    $id = $res['id'];

    $res = $db->query("SELECT * FROM user WHERE id = :id",[
        'id' => $id
    ])->fetchAll();
    $details = $res[0];

    $profile_pic =  "/git/Qspace/assets/uploads/".$details['profile_pic'];
    $default_pic =  "/git/Qspace/assets/pic.jpg"
?>
<body class="bg-gray-50">
    
    <?php require base_path("Controllers/components/setting_sidebar.php") ?>
        <!-- Scrollable Profile Content -->
        <div class="flex-1 ml-64 overflow-y-auto scrollable-profile h-full">
            <div class="bg-default-background p-6 md:p-12">
                <div class="w-full max-w-2xl mx-auto">
                    <!-- Account Section -->
                    <div class="flex w-full flex-col items-start gap-6 mb-12">
                        <div class="flex w-full flex-col items-start gap-1">
                            <h1 class="w-full text-3xl font-bold text-default-font">
                                Account
                            </h1>
                            
                            <p class="w-full text-gray-600">
                                Update your profile and personal details here
                            </p>
                        </div>

                        <!-- Profile Section -->
                        
                        <div class="w-full">
                        <form action= "<?php echo addRoute('update_profile') ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" value="PATCH" name="__method">
                            <h2 class="text-xl font-semibold text-default-font mb-6">
                                Profile
                            </h2>
                                <!-- Avatar -->
                                <div class="flex w-full flex-col items-start gap-4 mb-6">
                                    <span class="font-semibold text-default-font">
                                        Avatar
                                    </span>
                                    <div class="flex items-center gap-4">
                                        
                                        <img class="h-16 w-16 rounded-full object-cover"
                                            src="<?php echo $details['profile_pic'] ? $profile_pic : $default_pic  ?>" />
                                        
                                        <div class="flex flex-col items-start gap-2">
                                            
                                            <label class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 flex items-center cursor-pointer gap-2">
                                                <i class="fas fa-upload text-sm"></i>
                                                <input type="file" name="image" accept="image/*" class="hidden" /> 
                                                Upload
                                            </label>
                                            
                                            <!-- Show selected filename if there was an error -->
                                            <?php if (isset($errors['body']) && !empty($_FILES['image']['name'])): ?>
                                                <span class="text-sm text-gray-500">
                                                    Selected: <?php echo htmlspecialchars($_FILES['image']['name']) ?>
                                                </span>
                                            <?php endif; ?>
                                            
                                            <span class="text-sm text-subtext-color">
                                                For best results, upload an image 512x512 or larger.
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Name Fields -->
                                <div class="flex w-full flex-col md:flex-row gap-4 mb-6">
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" placeholder="<?php echo $details['username'] ?>" name="username" value="<?php echo isset($errors['body']) ? $_POST['username'] : $details['username'] ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="w-full mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" placeholder="<?php echo $details['email'] ?>" name="email" value="<?php echo isset($errors['body']) ? $_POST['email'] : $details['email'] ?> " 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <?php if(isset($errors['body'])):?>
                                    <p class="text-sm text-red-600"><?php echo $errors['body'] ?></p>
                                <?php endif ?>
                            </div>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save changes
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="h-px w-full bg-neutral-border my-6"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>