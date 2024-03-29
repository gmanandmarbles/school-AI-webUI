<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Chat</title>
    <link rel="stylesheet" href="newstyle.css">
    <script src="chatSystem/chat.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="line.css">
   <script src="script.js" defer=""></script>
  </head>
  <body>
    <nav class="nav">
      <i class="uil uil-bars navOpenBtn"></i>
            <div class="logo">
                <img src="<?php echo htmlspecialchars($_SESSION["school"]); ?>.png" alt="Logo">

            </div>
      <ul class="nav-links">
        <i class="uil uil-times navCloseBtn"></i>
        <li><a href="index.php">Home</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><p class="welcomeName">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></p></li>
<li><a href="logout.php">Logout</a>       
 </ul>
    </nav>
	<div class="containerhome">
        <h1 class="website-name">Chat</h1>
            
        <div id="chat-container"></div>
    
        <input type="text" id="user-input" onkeydown="if (event.keyCode === 13) {sendMessage(); return false;}">
        <button onclick="sendMessage()">Send</button>
	   <button onclick="downloadChat()">Download as JSON</button>
    <input type="file" id="file-input" accept=".json" onchange="uploadChat(event)">
        <p class="tagline"></p>
		<br>
		<div class="copyrighthome">
		<p>© Chat</a></p>
		</div>
    </div>

  
</body></html>
