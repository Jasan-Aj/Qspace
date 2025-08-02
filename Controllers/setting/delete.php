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
                                Account
                            </h1>
                            <p class="w-full text-gray-600">
                                Update your profile and personal details here
                            </p>
                        </div>

                        <!-- Divider -->
                        <div class="h-px w-full bg-neutral-border my-6"></div>

                        <!-- Danger Zone -->
                        <div class="w-full">
                            <h2 class="text-xl font-semibold text-default-font mb-6">
                                Danger zone
                            </h2>
                            
                            <div class="border border-red-200 bg-red-50 rounded-md p-4">
                                <form id="form" action="<?php echo addRoute('delete_account') ?>" method="post">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <input type="hidden" value="DELETE"  name="__method">
                                    <div>
                                        <h3 class="font-semibold text-red-800">Delete account</h3>
                                        <p class="text-sm text-red-600">Permanently remove your account. This action is not reversible.</p>
                                    </div>
                                    <button type="button" onclick="confirmSubmit()" class="px-4 py-2 border border-red-600 text-red-600 rounded-md hover:bg-red-100 whitespace-nowrap">
                                        Delete account
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
    <Script>
        function confirmSubmit(){
            if(confirm("Are you sure?")){
                document.getElementById("form").submit();
            }
        }
    </Script>
</body>
</html>