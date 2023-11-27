<?php
session_start();

include_once("config.php");
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT email, password FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row["password"];

    if ($email === "admin@admin" && $password === "admin"){
        $_SESSION["login"] = true;
        $_SESSION["user-email"] = "admin";
        header("location: ./log.php?login=true");
    } else if ($result->num_rows === 0) {
        header("location: login.php?incorrect=true");
    } else if (password_verify($password, $hashed_password)) {
        $_SESSION["login"] = true;
        $_SESSION["user-email"] = $email;
        header("location: ./log.php?login=true");
    } else {
        header("location: login.php?incorrect=true");
    }
}
