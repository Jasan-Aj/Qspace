
<div class="flex h-screen overflow-hidden">
        <!-- Fixed Settings Menu -->
        <div class="w-64 bg-white p-6 border-r border-neutral-border flex-shrink-0 fixed h-full">
            <span class="w-full text-2xl font-bold text-default-font block mb-6">
                Settings
            </span>
            <div class="flex w-full flex-col items-start gap-4 mb-8">
                <a href="rooms" class="w-full font-semibold text-default-font">
                    <i class="fas fa-home"></i>   Home
                </a>
            </div>
            <div class="flex w-full flex-col items-start gap-4 mb-8">
                <span class="w-full font-semibold text-default-font">
                    Personal
                </span>
                <div class="flex w-full flex-col items-start gap-2">
                    <a href="<?php echo addRoute('profile') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('profile') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> rounded-md font-medium">
                        <i class="fas fa-user"></i>        Account
                    </a>
                    <a href="<?php echo addRoute('change_password') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('change_password') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> rounded-md font-medium flex items-center gap-2">
                        <i class="fas fa-eye"></i>  Password
                    </a>
                    <a href="<?php echo addRoute('delete_account') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('delete_account') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> rounded-md font-medium flex items-center gap-2">
                       <i class="fas fa-trash-alt"></i> Delete account
                    </a>
                </div>
            </div>
            <div class="flex w-full flex-col items-start gap-4">
                <span class="w-full font-semibold text-default-font">
                    Your rooms
                </span>
                <div class="flex w-full flex-col items-start gap-2">
                    <a href="<?php echo addRoute('edit_rooms') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('edit_rooms') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> hover:bg-gray-50 rounded-md font-medium flex items-center gap-2">
                         <i class="fas fa-pencil-alt"></i>Edit rooms
                    </a>
                </div>
            </div>
        </div>