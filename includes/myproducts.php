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
$user_id = getName("id");
$data = getspecificData("announces", $user_id);
$user_image = getName("user_image");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="./style/style.css">
    <style>
        ul {
            list-style: none;
        }
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
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($announce['img']); ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $announce['title']; ?></h5>
                                <p class="card-text description"><?php echo $announce['descri']; ?></p>
                                <p class="card-text"><strong>Price: </strong><?php echo $announce['price']; ?>Dhs</p>
                                <p class="card-text"><strong>Phone:</strong> <?php echo $announce['phone']; ?></p>
                                <?php if ($announce["user_id"] === $user_id || $_SESSION["user-email"] == "admin") { ?>
                                    <a href="edit.php/?id=<?php echo $announce["id"]; ?>" class="btn btn-primary">Edit</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#remove_<?php echo $announce["id"]; ?>">
                                        Delete
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="remove_<?php echo $announce["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="removeModalLabel">Remove Item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to remove "<?php echo $announce["title"]; ?>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="./includes/delete.php/?id=<?php echo $announce["id"]; ?>" method="post">
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>
                                    </div>
                                </div>
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