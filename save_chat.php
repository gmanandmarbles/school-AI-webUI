<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chat = $_POST['message'];
    $userId = $_SESSION["id"];

    $sql = "UPDATE users SET chat = ? WHERE id = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $chat, $userId);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array("response" => "Message saved successfully."));
        } else {
            echo json_encode(array("response" => "Failed to save message."));
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("response" => "Failed to prepare statement."));
    }
    mysqli_close($link);
} else {
    echo json_encode(array("response" => "Invalid request method."));
}
?>
