<?php
session_start();
include_once("./getData.php");
if (isset($_GET["id"]))
    $announce_id = $_GET["id"];
$data = getAnnounce($announce_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <style>
        ul {
            list-style: none;
        }

        body {
            background-color: #f8f9fa;
            /* Set a background color for the body */
        }

        .full-card {
            width: 100%;
            max-width: 600px;
            /* Set a maximum width for the card */
            margin: auto;
            margin-top: 50px;
            /* Add some top margin for better visibility */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 ">
        <a href="../../index.php" class="navbar-brand">
            <img src="https://www.avito.ma/phoenix-assets/imgs/layout/new-logo.svg" alt="Logo" height="60">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user_image); ?>" class="rounded-circle mb-3" style="width: 50px;" onclick="profileNav()" alt="User Image">
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
                                <a href="./myproducts.php" class="nav-link text-dark">My Products</a>
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
        <div class="container">
            <div class="row">
                <?php foreach ($data as $announce) { ?>
                    <div class="col-md-12 mb-4">
                        <div class="card full-card">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($announce['img']); ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $announce['title']; ?></h5>
                                <p class="card-text description"><?php echo $announce['descri']; ?></p>
                                <p class="card-text"><strong>Price: </strong><?php echo $announce['price']; ?>Dhs</p>
                                <p class="card-text"><strong>Phone:</strong> <?php echo $announce['phone']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>