<?php 
    require base_path("Controllers/components/header.php");
?>

    <style>
        .chat-message {
            max-width: 80%;
            word-wrap: break-word;
        }
        .user-message {
            margin-left: auto;
        }
        .bot-message {
            margin-right: auto;
        }
        #chat-container {
            height: 70vh; /* Set a fixed height for better scrolling */
            overflow-y: auto;
        }
    </style>

    <?php require base_path('Controllers/components/sidebar.php') ?>
    <section class="home-section">
    <div class="container min-h-screen mx-auto max-w-3xl flex-1 flex flex-col p-4">
        <h1 class="text-2xl font-bold text-center mb-4 text-blue-600">AI Chatbot</h1>
        
        
        <div id="chat-container" class="flex-1 bg-white rounded-lg shadow-md p-4 mb-4 overflow-y-auto">
            <div id="messages-container" class="space-y-4">
                <!-- Messages will appear here -->
                <div class="chat-message bot-message bg-blue-100 p-3 rounded-lg">
                    Hello! How can I help you today?
                </div>
            </div>
        </div>
        
        
        <div class="flex gap-2">
            <input 
                id="user-input" 
                type="text" 
                placeholder="Type your message..." 
                class="flex-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button 
                id="send-button" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-200"
            >
                Send
            </button>
        </div>
    </div>

    <script>
        const chatContainer = document.getElementById('chat-container');
        const messagesContainer = document.getElementById('messages-container');
        const userInput = document.getElementById('user-input');
        const sendButton = document.getElementById('send-button');
        
        
        function scrollToBottom() {
            
            chatContainer.scrollTo({
                top: chatContainer.scrollHeight,
                behavior: 'smooth'
            });
        }
        
        
        scrollToBottom();
        
      
        function addMessage(content, isUser) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `chat-message ${isUser ? 'user-message bg-green-100' : 'bot-message bg-blue-100'} p-3 rounded-lg`;
            messageDiv.textContent = content;
            
            messagesContainer.appendChild(messageDiv);
            
           
            scrollToBottom();
        }
        
        
        async function sendMessage() {
            const message = userInput.value.trim();
            if (!message) return;
            
            addMessage(message, true);
            userInput.value = '';
            
            try {
              
                const typingIndicator = document.createElement('div');
                typingIndicator.className = 'chat-message bot-message bg-blue-100 p-3 rounded-lg italic text-gray-500';
                typingIndicator.textContent = 'AI is typing...';
                messagesContainer.appendChild(typingIndicator);
                scrollToBottom();
                
                
                const response = await puter.ai.chat(message, { model: "gpt-4.1-nano" });
                
                
                messagesContainer.removeChild(typingIndicator);

                
                addMessage(response, false);
            } catch (error) {
                addMessage("Sorry, I encountered an error. Please try again.", false);
                console.error(error);
            }
        }
        
        sendButton.addEventListener('click', sendMessage);
        userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
    </section>
</body>
</html>
