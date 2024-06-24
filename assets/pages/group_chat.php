<?php
session_start();
require_once 'config.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("database is not connected");

function sendMessage($user_id, $msg){
    global $db;
    $current_user_id = $_SESSION['userdata']['id'];
    $query = "INSERT INTO messages (from_user_id, to_user_id, msg) VALUES ($current_user_id, $user_id, '$msg')";
    return mysqli_query($db, $query);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Group Chat</title>
    <script>
        let conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            let data = JSON.parse(e.data);
            let chatBox = document.getElementById('chat-box');
            chatBox.innerHTML += '<div><strong>' + data.user + ':</strong> ' + data.msg + '</div>';
        };

        function sendMessage() {
            let msgInput = document.getElementById('msg-input');
            let message = msgInput.value;
            let data = {
                user: '<?php echo $_SESSION["userdata"]["username"]; ?>',
                msg: message
            };
            conn.send(JSON.stringify(data));
            msgInput.value = '';

            // Store the message in the database
            fetch('store_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
        }
    </script>
</head>
<body>
    <div id="chat-box"></div>
    <input type="text" id="msg-input">
    <button onclick="sendMessage()">Send</button>
</body>
</html>
