<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "avito"; // Specify the database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database); // Include the database name
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS avito"; // Use IF NOT EXISTS to avoid errors if the database already exists
if ($conn->query($sql) === TRUE) {
    echo "<script> console.log('Database created successfully'); </script>";
} else {
    echo "<script>console.log('Error creating database: ' . $conn->error)</script>";
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS announces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    img LONGBLOB, 
    price INT,
    descri VARCHAR(255), -- Corrected the column name
    phone VARCHAR(13)
)";
if ($conn->query($sql) === TRUE) {
    echo "<script> console.log('Table created successfully'); </script>";
} else {
    echo "<script>console.log('Error creating table: ' . $conn->error)</script>";
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS  users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    email VARCHAR(255),
    passowrd VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "<script> console.log('Table created successfully'); </script>";
} else {
    echo "<script>console.log('Error creating table: ' . $conn->error)</script>";
}
?>
