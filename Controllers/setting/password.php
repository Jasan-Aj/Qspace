<?php require base_path("Controllers/components/setting_header.php") ?>
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
                                Change Password
                            </h1>
                            <p class="w-full text-gray-600">
                                Update your Password here
                            </p>
                        </div>

                        <!-- Divider -->
                        <div class="h-px w-full bg-neutral-border my-6"></div>

                    <form class="w-[80%]" action="<?php echo addRoute('update_password') ?>" method="post">
                        
                    <input type="hidden" value="PATCH" name="__method">
                        <div class="w-full" id="#password">
                            
                            
                            <div class="w-full mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current password</label>
                                <input type="password" placeholder="Enter current password" name="currpassword" value="<?php echo isset($errors['body']) ? $_POST['currpassword'] : ''  ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="w-full mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">New password</label>
                                <input type="password" placeholder="Enter new password" name="newpassword" value="<?php echo isset($errors['body']) ? $_POST['newpassword'] : ''  ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="w-full mb-6">
                                <input type="password" placeholder="Re-type new password" name="repassword" value="<?php echo isset($errors['body']) ? $_POST['repassword'] : ''  ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <p class="text-sm text-subtext-color mb-4"><?php echo isset($errors['body']) ? $errors['body'] : ''?></p>

                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Change password
                            </button>
                        </div>
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