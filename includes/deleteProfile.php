<?php
include("./config.php");

$id = $_GET["id"];

// Using a prepared statement to prevent SQL injection
$stmt = $conn->prepare("DELETE FROM users WHERE id in (select id from users where id = ?)");
$stmt->bind_param("i", $id);
$stmt->execute();

// Check for errors in query and connection
if ($stmt->error) {
    die('Error in user deletion: ' . $stmt->error);
}

$stmt->close();

// Now delete announces related to the user
$stmt = $conn->prepare("DELETE FROM announces WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Check for errors in query and connection
if ($stmt->error) {
    die('Error in announces deletion: ' . $stmt->error);
}

$stmt->close();
    header("location: ../../admin/dashboard.php");
?>
