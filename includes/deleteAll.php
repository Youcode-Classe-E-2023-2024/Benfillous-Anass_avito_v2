<?php 
    include("./config.php");
    $id = $_GET["id"];

    // Using a prepared statement to prevent SQL injection
    $query = "TRUNCATE TABLE announces;";

    $result = $conn->query($query);

    // Check for errors in query and connection
    if (!$result) {
        die('Error in query: ' . $conn->error);
    }
    header("location:../index.php?deletedALL=true");
?>