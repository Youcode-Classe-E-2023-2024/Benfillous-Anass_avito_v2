<?php
session_start();
if (isset($_GET["login"])) {
    if ($_GET["login"] == false)
        $_SESSION["login"] = true;
} else if ($_SESSION["user-email"] === "admin")
    $_SESSION["login"] = true;
else {
    $_SESSION["login"] = false;
    $_SESSION["user-email"] = "";
}

if (isset($_GET["log"]) || isset($_GET["logout"])) {
    $_SESSION["login"] = false;
    $_SESSION["user-email"] = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>

<style>
    body {
        height: 700px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body>
    <div class="loader"></div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 2000);
        });
    </script>
</body>

</html>