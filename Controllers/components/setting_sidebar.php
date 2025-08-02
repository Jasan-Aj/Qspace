
<div class="flex h-screen overflow-hidden">
        <!-- Fixed Settings Menu -->
        <div class="w-64 bg-white p-6 border-r border-neutral-border flex-shrink-0 fixed h-full">
            <span class="w-full text-2xl font-bold text-default-font block mb-6">
                Settings
            </span>
            <div class="flex w-full flex-col items-start gap-4 mb-8">
                <span class="w-full font-semibold text-default-font">
                    Personal
                </span>
                <div class="flex w-full flex-col items-start gap-2">
                    <a href="<?php echo addRoute('profile') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('profile') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> rounded-md font-medium">Account</a>
                    <a href="<?php echo addRoute('change_password') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('change_password') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> rounded-md font-medium flex items-center gap-2">
                        Password
                    </a>
                    <a href="<?php echo addRoute('delete_account') ?>" class="w-full px-3 py-2 <?php echo parse_url($_SERVER['REQUEST_URI'])['path'] == addRoute('delete_account') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' ?> rounded-md font-medium flex items-center gap-2">
                        Delete account
                    </a>
                </div>
            </div>
            <div class="flex w-full flex-col items-start gap-4">
                <span class="w-full font-semibold text-default-font">
                    Workspace
                </span>
                <div class="flex w-full flex-col items-start gap-2">
                    <a href="#" class="w-full px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-md font-medium flex items-center gap-2">
                        <i class="fas fa-credit-card text-sm"></i> Billing
                    </a>
                    <a href="#" class="w-full px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-md font-medium flex items-center gap-2">
                        <i class="fas fa-shapes text-sm"></i> Integrations
                    </a>
                    <a href="#" class="w-full px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-md font-medium flex items-center gap-2">
                        <i class="fas fa-users text-sm"></i> Team Members
                    </a>
                </div>
            </div>
        </div>