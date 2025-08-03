<?php


$config = require base_path("Core/config.php");
$db = new Database($config);

$room_id = $_GET['id'];
$room = $db->query("SELECT * FROM rooms WHERE id = :id",[
    "id" => $room_id
])->fetch();


$user = $db->query("SELECT username from user WHERE id = :id",[
    'id' => $_SESSION['user_id']
])->fetch()

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($room['name']) ?> - Chat Room</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto max-w-4xl p-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Room Header -->
            <div class="bg-blue-600 text-white p-4">
                <h1 class="text-2xl font-bold"><?= htmlspecialchars($room['name']) ?></h1>
                <p class="text-blue-100"><?= htmlspecialchars($room['topic']) ?></p>
                <p class="text-blue-100">Members: <?= $room['members_count'] ?></p>
            </div>
            
            <!-- Chat Messages -->
            <div id="chat-messages" class="p-4 h-96 overflow-y-auto">
                <!-- Messages will be loaded here via AJAX -->
            </div>
            
            <!-- Message Input -->
            <div class="border-t p-4 bg-gray-50">
                <form id="message-form" class="flex gap-2">
                    <input type="hidden" id="room_id" value="<?= $room_id ?>">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['user_id'] ?>">
                    <input type="text" id="message-content" 
                           class="flex-grow p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Type your message..." required>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>