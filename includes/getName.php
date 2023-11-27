<?php
function getName($dataNeeded) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "avito"; // Specify the database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    $email = $_SESSION['user-email'];
    if ($email != "admin") {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
    } else 
        return "admin";
    return $row[$dataNeeded];
}
?>