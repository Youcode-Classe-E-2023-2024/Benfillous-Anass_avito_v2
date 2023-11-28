<?php
include("./config.php");
$id = $_GET["id"];

// Using a prepared statement to prevent SQL injection
$query = "DELETE FROM announces WHERE id = $id";

$result = $conn->query($query);

// Check for errors in query and connection
if (!$result) {
    die('Error in query: ' . $conn->error);
}

if (isset($_GET["admin"]))
    header("location:   ../../admin/dashboard.php");
else
    header("location:../../index.php?deleted=true");
