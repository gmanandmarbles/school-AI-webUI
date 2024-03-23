var chatHistory = []; // Initialize chat history as an empty array

function sendMessage() {
    var userInput = document.getElementById("user-input").value;
    var chatContainer = document.getElementById("chat-container");
    document.getElementById("user-input").value = ""; // Clear the input box

    // Displaying user message immediately
    chatContainer.innerHTML += "<div class='message-container'><div class='user-message'>" + userInput + "</div></div>";

    // Displaying an ellipsis while waiting for response
    chatContainer.innerHTML += "<div class='message-container'><div class='bot-message'>...</div></div>";

    fetch('http://68.146.5.150:5000/api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({message: userInput})
    })
    .then(response => response.text())
    .then(data => {
        // Replace ellipsis with server response
        var lastMessageContainer = chatContainer.lastElementChild;
        lastMessageContainer.innerHTML = "<div class='bot-message'>" + data + "</div>";

        // Add the message to chat history
        chatHistory.push({ user: userInput, bot: data });

        // Auto-scroll to the bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
}

function downloadChat() {
    const data = JSON.stringify(chatHistory, null, 2);
    const blob = new Blob([data], { type: 'application/json' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'chat_history.json';
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a);
}

function uploadChat(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const contents = e.target.result;
        try {
            const jsonData = JSON.parse(contents);
            if (Array.isArray(jsonData)) {
                chatHistory = jsonData;
                renderChat();
            } else {
                console.error('Invalid JSON format. Expected an array.');
            }
        } catch (error) {
            console.error('Error parsing JSON:', error);
        }
    };
    reader.readAsText(file);
}

function renderChat() {
    const chatContainer = document.getElementById("chat-container");
    chatContainer.innerHTML = "";
    chatHistory.forEach(item => {
        chatContainer.innerHTML += "<div class='message-container'><div class='user-message'>" + item.user + "</div></div>";
        chatContainer.innerHTML += "<div class='message-container'><div class='bot-message'>" + item.bot + "</div></div>";
    });
    // Auto-scroll to the bottom
    chatContainer.scrollTop = chatContainer.scrollHeight;
}
