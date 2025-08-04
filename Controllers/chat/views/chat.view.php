<?php

$config = require base_path("Core/config.php");
$db = new Database($config);

$room_id = $_GET['id'];
$room = $db->query("SELECT * FROM rooms WHERE id = :id",[
    "id" => $room_id
])->fetch();

$user = $db->query("SELECT username from user WHERE id = :id",[
    'id' => $_SESSION['user_id']
])->fetch();

$members_details = [];

$room_members_ids = $db->query("SELECT user_id FROM room_members WHERE room_id = :id",[
    'id' => $room_id
])->fetchAll();

$default_profile = "pic.png";
$profile_pic =  "/git/Qspace/assets/uploads/";

foreach($room_members_ids as $id){
    $res = $db->query("SELECT username, profile_pic FROM user WHERE id = :id",[
        'id' => $id['user_id']
    ])->fetch();
    $members_details[] = $res;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Chat Room</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#e5f4f9',
                            DEFAULT: '#3B82F6',
                            dark: '#1b3774ff',
                            darker: '#0A2558',
                        },
                        secondary: {
                            light: '#f0fdf4',
                            DEFAULT: '#10B981',
                            dark: '#059669',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .chat-bg {
            background-color: #e5ddd5;
            background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.1'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body class="bg-gray-100 h-screen overflow-hidden">
    <div class="flex h-full">
        <!-- Left Sidebar (Minimizable) -->
        <div id="sidebar" class="w-64 md:w-20 bg-primary-darker text-white transition-all duration-300 flex flex-col h-full border-r border-primary-dark">
            <!-- Sidebar Header -->
            <div class="p-4 flex items-center justify-between border-b border-primary-dark">
                <div id="sidebar-logo" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-primary-dark flex items-center justify-center">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                    <span id="sidebar-title" class="font-semibold md:hidden">ChatApp</span>
                </div>
                
            </div>
            
            <!-- User Profile -->

            <div class="p-3 flex items-center space-x-3 hover:bg-primary-dark cursor-pointer border-b border-primary-dark">
                <div class="w-10 h-10 rounded-full bg-primary-dark flex items-center justify-center">
                    <i class="fas fa-user"></i>
                </div>
                <div id="sidebar-user" class="md:hidden">
                    <p class="font-medium"><?php echo $user['username'] ?></p>
                    <p class="text-xs text-gray-300">Online</p>
                </div>
            </div>

            <a href="<?php echo addRoute('rooms') ?>"><div class="p-3 flex items-center space-x-3 hover:bg-primary-dark cursor-pointer border-b border-primary-dark">
                <div class="w-10 h-10 rounded-full bg-primary-dark flex items-center justify-center">
                    <i class="fas fa-home"></i>
                </div>
                <div id="sidebar-user" class="md:hidden">
                    <p class="font-medium"><?php echo $user['username'] ?></p>
                    <p class="text-xs text-gray-300">Online</p>
                </div>
            </div></a>

            <div class="overflow-y-auto custom-scrollbar flex-1">
                <div class="p-2">
                    <h3 class="text-xs uppercase text-gray-400 mb-2 px-2 md:hidden">Your Rooms</h3>
                    <div class="space-y-1">
                        <a href="<?php echo addRoute('myrooms') ?>" class="flex items-center p-2 rounded hover:bg-primary-dark">
                            <div class="w-8 h-8 rounded-full bg-primary-dark flex items-center justify-center mr-2">
                                <i class="fas fa-users text-sm"></i>
                            </div>
                            <span class="md:hidden">Your Rooms</span>
                        </a>
                        
                    </div>
                </div>
            </div>

            
            
            
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden bg-white">
            <!-- Chat Header -->
            <div class="bg-primary text-white p-3 flex items-center justify-between border-b border-primary-dark">
                <div class="flex items-center space-x-3">
                    <button id="toggle-sidebar-mobile" class="md:hidden text-white">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-primary-darker flex items-center justify-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h1 class="font-semibold text-lg"><?php echo $room['name'] ?></h1>
                        <p class="text-xs text-primary-light"></p>
                    </div>
                </div>
                
                <!-- Room Options Dropdown -->
                <div class="relative">
                    <button id="room-options-btn" class="p-2 rounded-full hover:bg-primary-dark">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div id="room-options-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-info-circle mr-2"></i>Room info</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-search mr-2"></i>Search messages</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-bell-slash mr-2"></i>Mute notifications</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-sign-out-alt mr-2"></i>Exit room</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" class="flex-1 overflow-y-auto p-4 chat-bg custom-scrollbar">
                <!-- Date divider -->
                <div class="text-center py-4">
                    <div class="inline-block bg-white rounded-lg px-4 py-1 shadow">
                        <p class="text-sm text-gray-600">Today</p>
                    </div>
                </div>
                
                
                
                <!-- File attachment example -->
                <!-- <div class="flex mb-4 justify-start">
                    <div class="flex max-w-xs md:max-w-md lg:max-w-lg">
                        <div class="bg-white rounded-lg py-2 px-3 shadow">
                            <p class="text-xs font-semibold text-gray-700">Sarah Johnson</p>
                            <div class="border border-gray-200 rounded p-2 mt-1 flex items-center">
                                <div class="bg-blue-100 p-2 rounded mr-2">
                                    <i class="fas fa-file-pdf text-red-500"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Project_Specs.pdf</p>
                                    <p class="text-xs text-gray-500">2.4 MB</p>
                                </div>
                                <button class="ml-auto text-primary hover:text-primary-dark">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                            <p class="text-right text-xs mt-1 text-gray-500">10:38 AM</p>
                        </div>
                    </div>
                </div> -->
            </div>
            
            <!-- Message Input -->
            <div class="bg-gray-50 p-3 border-t border-gray-200">
                <form id="message-form" class="flex items-center space-x-2">
                    <input type="hidden" id="room_id" value="<?= $room_id ?>">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['user_id'] ?>">
                    
                    <!-- File upload button (hidden input) -->
                    <input type="file" id="file-upload" class="hidden" multiple>
                    <button type="button" id="file-upload-btn" class="p-2 rounded-full text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-paperclip"></i>
                    </button>
                    
                    <!-- Emoji picker button -->
                    <button type="button" class="p-2 rounded-full text-gray-600 hover:bg-gray-200">
                        <i class="far fa-smile"></i>
                    </button>
                    
                    <!-- Message input -->
                    <div class="flex-1 bg-white rounded-full px-4 py-2 border border-gray-200 focus-within:border-primary">
                        <input type="text" id="message-content" 
                               class="w-full focus:outline-none" 
                               placeholder="Type a message" required>
                    </div>
                    
                    <!-- Send button -->
                    <button type="submit" class="px-4 py-3 rounded-full text-white bg-primary hover:bg-primary-dark disabled:opacity-50" id="send-btn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                
                <!-- File preview area (hidden by default) -->
                <div id="file-preview" class="hidden mt-2 p-2 bg-blue-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded mr-2">
                                <i class="fas fa-file text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium" id="file-name">filename.ext</p>
                                <p class="text-xs text-gray-500" id="file-size">0 MB</p>
                            </div>
                        </div>
                        <button id="remove-file" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Members Section -->
        <div id="members-section" class="w-64 bg-white border-l border-gray-200 hidden lg:flex flex-col h-full">
            <div class="p-4 border-b border-gray-200">
                <h2 class="font-semibold text-lg">Group Members</h2>
                <p class="text-sm text-gray-500"><?php echo getRoomMemberCount($room['id']) ?> Participants</p>
            </div>
            
            <div class="overflow-y-auto custom-scrollbar flex-1 p-2">
                
                <?php foreach($members_details as $details):?>

                <div class="flex items-center p-3 hover:bg-gray-100 rounded-lg cursor-pointer">
                    <img src="/git/Qspace/assets/uploads/<?php echo $details['profile_pic'] != null ? $details['profile_pic'] : $default_profile ?>" class="w-10 h-10 rounded-full  mr-3">
                    <div>
                        <p class="font-medium"><?php echo $details['username'] ?></p>
                        <p class="text-xs text-gray-500">Online</p>
                    </div>
                </div>

                <?php endforeach ?>
                
            </div>
            <?php if($room['host'] == $_SESSION['user_id']) :?>

            <div class="p-4 border-t border-gray-200">
                <a href="<?php echo addRoute('destroy_room') ?>\?id=<?php echo $room_id ?>" class="w-full py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Delete Group</span>
                </a>
            </div>

            <?php else: ?>

                <div class="p-4 border-t border-gray-200">
                <a href="<?php echo addRoute('left_room') ?>\?id=<?php echo $room_id ?>" class="w-full py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Leave Group</span>
                </a>
            </div>
            <?php endif ?>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const toggleSidebarMobile = document.getElementById('toggle-sidebar-mobile');
        const membersSection = document.getElementById('members-section');
        const optionsBtn = document.getElementById('room-options-btn');
        const optionsMenu = document.getElementById('room-options-menu');
        const fileUploadBtn = document.getElementById('file-upload-btn');
        const fileUploadInput = document.getElementById('file-upload');
        const filePreview = document.getElementById('file-preview');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const removeFileBtn = document.getElementById('remove-file');
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-content');
        const sendBtn = document.getElementById('send-btn');
        const chatMessages = document.getElementById('chat-messages');

        // Function to load messages
        function loadMessages() {
            const roomId = document.getElementById('room_id').value;
            fetch(`get-messages?room_id=${roomId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('chat-messages').innerHTML = data;
                    // Auto-scroll to bottom
                    const chatContainer = document.getElementById('chat-messages');
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
        }

        // Send message via AJAX
        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const roomId = document.getElementById('room_id').value;
            const userId = document.getElementById('user_id').value;
            const content = document.getElementById('message-content').value;
            
            fetch('send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `room_id=${roomId}&user_id=${userId}&content=${encodeURIComponent(content)}`
            })
            .then(response => response.text())
            .then(() => {
                document.getElementById('message-content').value = '';
                loadMessages();
            });
        });

        // Load messages initially and then every 2 seconds
        loadMessages();
        setInterval(loadMessages, 2000);

        // Toggle sidebar on mobile
        toggleSidebarMobile.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // Toggle sidebar minimize
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('md:w-20');
            sidebar.classList.toggle('md:w-64');
            
            // Toggle visibility of elements that should hide when minimized
            document.querySelectorAll('#sidebar-title, #sidebar-user, .md\\:hidden').forEach(el => {
                el.classList.toggle('hidden');
                el.classList.toggle('md:hidden');
            });
        });

        // Room options dropdown
        optionsBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            optionsMenu.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!optionsBtn.contains(e.target) && !optionsMenu.contains(e.target)) {
                optionsMenu.classList.add('hidden');
            }
        });

        // File upload handling
        fileUploadBtn.addEventListener('click', () => {
            fileUploadInput.click();
        });

        fileUploadInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                filePreview.classList.remove('hidden');
            }
        });

        removeFileBtn.addEventListener('click', () => {
            fileUploadInput.value = '';
            filePreview.classList.add('hidden');
        });

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        

        // Enable/disable send button based on input
        messageInput.addEventListener('input', () => {
            sendBtn.disabled = messageInput.value.trim() === '' && !fileUploadInput.files[0];
        });

       

        
        // Get appropriate icon for file type
        function getFileIcon(fileType) {
            if (!fileType) return 'fas fa-file';
            
            const type = fileType.split('/')[0];
            const subtype = fileType.split('/')[1];
            
            switch(type) {
                case 'image':
                    return 'fas fa-file-image';
                case 'video':
                    return 'fas fa-file-video';
                case 'audio':
                    return 'fas fa-file-audio';
                case 'application':
                    if (subtype.includes('pdf')) return 'fas fa-file-pdf';
                    if (subtype.includes('msword') || subtype.includes('wordprocessingml')) return 'fas fa-file-word';
                    if (subtype.includes('spreadsheetml') || subtype.includes('excel')) return 'fas fa-file-excel';
                    if (subtype.includes('presentationml') || subtype.includes('powerpoint')) return 'fas fa-file-powerpoint';
                    if (subtype.includes('zip') || subtype.includes('compressed')) return 'fas fa-file-archive';
                    return 'fas fa-file-code';
                default:
                    return 'fas fa-file';
            }
        }

        // Format time for display
        function formatTime(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        // Initial scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    </script>
</body>
</html>