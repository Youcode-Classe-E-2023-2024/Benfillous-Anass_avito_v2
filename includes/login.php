<?php
session_start();
if (isset($_SESSION["login"])) {
    if ($_SESSION["login"])
        header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login/Signup Form</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- Add your custom styles here if needed -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .form-container form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #000000;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        <?php
        if ($_GET["incorrect"]) {
        ?>.incorrect {
            border: solid 1px red;
        }

        <?php
        }
        ?>
    </style>
</head>

<body>
    <div class="container form-container">
        <form id="loginForm" action="signinHandler.php" method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="loginEmail">Email address</label>
                <input onkeyup="removeRedColor(0);" type="email" name="email" class="form-control incorrect js-checker" id="loginEmail" placeholder="Enter email" />
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input onkeyup="removeRedColor(1);" type="password" name="password" class="form-control incorrect js-checker" id="loginPassword" placeholder="Password" />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center mt-3">
                Don't have an account? <a href="#signupForm">Sign up</a>
            </p>
        </form>

        <form id="signupForm" style="display: none" action="signupHandler.php" enctype="multipart/form-data" method="post">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="signupImage">Profile Picture</label>
                <input type="file" accept="image/png, image/jpeg" class="form-control" name="profile" id="signupImage"/>
            </div>
            <div class="form-group">
                <label for="signupName">Username</label>
                <input type="text" class="form-control" name="username" id="signupName" placeholder="Enter your username" />
            </div>
            <div class="form-group">
                <label for="signupEmail">Email address</label>
                <input type="email" name="email" class="form-control" id="signupEmail" placeholder="Enter email" />
            </div>
            <label>Select Role:</label>
            <div class="d-flex justify-content-around">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-info">
                        <input type="radio" name="role" value="1"> Buyer
                    </label>
                    <label class="btn btn-info">
                        <input type="radio" name="role" value="2"> Seller
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="signupPassword">Password</label>
                <input type="password" name="password" class="form-control" id="signupPassword" placeholder="Password" />
            </div>
            <div class="form-group">
                <label for="signupPassword">Confirm Password</label>
                <input type="password" name="re-password" class="form-control" id="signupRePassword" placeholder="Retype Password" />
            </div>
            <button type="submit" class="btn btn-success btn-block">Sign Up</button>
            <p class="text-center mt-3">
                Already have an account? <a href="#loginForm">Login</a>
            </p>
        </form>
    </div>

    <!-- Add Bootstrap JS and Popper.js if needed -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // Toggle between login and signup forms
        $(document).ready(function() {
            $('a[href="#signupForm"]').on("click", function() {
                $("#loginForm").hide();
                $("#signupForm").show();
            });

            $('a[href="#loginForm"]').on("click", function() {
                $("#signupForm").hide();
                $("#loginForm").show();
            });
        });
        let incorrect = document.getElementsByClassName("js-checker");

        function removeRedColor(elm) {
            if (incorrect[elm].classList[1] === "incorrect") {
                incorrect[elm].classList.remove("incorrect");
            }
        }
    </script>
</body>

</html>