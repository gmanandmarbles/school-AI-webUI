<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userId = $_SESSION["id"];

    $sql = "SELECT chat FROM users WHERE id = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $chat);
            mysqli_stmt_fetch($stmt);
            echo json_encode(array("success" => true, "chat" => $chat));
        } else {
            echo json_encode(array("success" => false, "error" => "Failed to load chat data."));
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("success" => false, "error" => "Failed to prepare statement."));
    }
    mysqli_close($link);
} else {
    echo json_encode(array("success" => false, "error" => "Invalid request method."));
}
?>
