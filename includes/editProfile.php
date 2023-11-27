<?php
session_start();
include_once("./getName.php");
if ($_SESSION["login"] == true || $_SESSION["user-email"] === "admin") {
    echo "Welcome" . " " . getName("username");
} else if ($_SESSION["user-email"] === "admin" && empty($_GET["admin"]))
    header("location: ../admin/dashboard.php");
else {
    header("location: ./login.php");
}

include_once("./getData.php");
$data = getData("announces");
$user_id = getName("id");
$user_image = getName("user_image");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <style>
        ul {
            list-style: none;
        }

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 ">
        <a href="../index.php" class="navbar-brand">
            <img src="https://www.avito.ma/phoenix-assets/imgs/layout/new-logo.svg" alt="Logo" height="60">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user_image); ?>" class="rounded-circle mb-3" style="width: 150px;" onclick="profileNav()" alt="User Image">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <ul class="drop-list">
                        <li class="nav-item">
                            <a href="./editProfile.php?<?php echo $user_id; ?>" class="nav-link text-dark">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="./includes/handelForm.php" class="nav-link text-dark">Add Product</a>
                        </li>
                        <?php if ($_SESSION["user-email"] === "admin") { ?>
                            <li class="nav-item">
                                <a href="./admin/dashboard.php" class="nav-link text-dark">Dashboard</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="./includes/myproducts.php" class="nav-link text-dark">My Products</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="./includes/log.php?log=false" class="nav-link text-dark">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <form id="editProfileForm" action="editProfile.php" enctype="multipart/form-data" method="post">
            <h2>Edit Profile</h2>
            <div class="form-group">
                <label for="signupImage">Profile Picture</label>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($user_image); ?>" class="rounded-circle mb-3" style="width: 150px;" alt="User Image">
                <input type="file" accept="image/png, image/jpeg" class="form-control" name="profile" id="signupImage" />
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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>