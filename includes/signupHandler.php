<?php
include_once("config.php");
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"])) {
    $username = $_POST["username"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $re_password = $_POST["re-password"];
    $img = file_get_contents($_FILES['profile']['tmp_name']);

    if ($password != $re_password) {
        header("location: login.php?signupError=true");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows != 0) {
            echo 'email already used';
            header("location: login.php?signupError=true");
        } else if ($email) {
            $query = "INSERT INTO users (username, role, email, password, user_image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sisss", $username, $role, $email, $password, $img);

            if ($stmt->execute()) {
                echo "<script> console.log('Record inserted successfully'); </script>";
            } else {
                echo "<script>console.log('Error inserting record: ' . $stmt->error)</script>";
            }
        }
        // header("location: ../index.php");
    }
}
