<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include_once("./includes/getName.php");
if ($_SESSION["login"] == true || $_SESSION["user-email"] === "admin") {
    echo "Welcome" . " " . getName("username");
} else if ($_SESSION["user-email"] === "admin" && empty($_GET["admin"]))
    header("location: ./admin/dashboard.php");
else {
    header("location: includes/login.php");
}

include_once("./includes/getData.php");
$data = getData("announces");
$user_id = getName("id");
$user_image = getName("user_image");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>avito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./includes/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        ul {
            list-style: none;
        }

        .cursor {
            cursor: pointer;
        }

        .red {
            color: red !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 ">
        <a href="./index.php" class="navbar-brand">
            <img src="https://www.avito.ma/phoenix-assets/imgs/layout/new-logo.svg" alt="Logo" height="60">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user_image); ?>" class="rounded-circle mb-3" style="width: 70px;" onclick="profileNav()" alt="User Image">
                </button>
                <div class="dropdown-menu drop" aria-labelledby="dropdownMenuButton">
                    <ul class="drop-list">
                        <?php if ($_SESSION["user-email"] != "admin") { ?>
                            <li class="nav-item">
                                <a href=" ./includes/editProfile.php" class="nav-link text-dark">Edit Profile</a>
                            </li>
                        <?php } ?>
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
        <?php
        if (isset($_GET["updated"])) {
        ?>
            <div class="alert alert-primary js-alert" role="alert">
                The Announce is Updated Succesfully
            </div>
        <?php } ?>
        <?php
        if (isset($_GET["deleted"])) {
        ?>
            <div class="alert alert-warning js-alert" role="alert">
                The Announce is Deleted Succesfully
            </div>
        <?php } ?>

        <?php
        if (isset($_GET["deletedALL"])) {
        ?>
            <div class="alert alert-warning js-alert" role="alert">
                ALL The Announces are Deleted Succesfully
            </div>
        <?php } ?>

        <?php
        if (isset($_GET["added"])) {
        ?>
            <div class="alert alert-success js-alert" role="alert">
                The Announce is Added Succesfully
            </div>
        <?php } ?>

        <?php
        if (isset($_GET["error"]) == true) {

        ?>
            <div class="alert alert-danger js-alert" role="alert">
                The data You've Entered is Incorrect
            </div>

        <?php
        }
        ?>

        <div class="container">
            <div class="row">
                <?php foreach ($data as $announce) { ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($announce['img']); ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $announce['title']; ?></h5>
                                <p class="card-text description"><?php echo $announce['descri']; ?></p>
                                <div class="d-flex justify-content-between">
                                    <p style="color:green;" class="card-text"><strong>Price: </strong><?php echo $announce['price']; ?> Dhs</p>
                                    <p class="card-text"><strong>Phone:</strong> <?php echo $announce['phone']; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="./includes/productPage.php/?id=<?php echo $announce["id"]; ?>" class="btn btn-primary">See More</a>
                                    <i class="fa fa-heart cursor favorite" style="font-size:30px;color:gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php
        if (count($data) == 0) {
        ?>
            <div class="empty"> the List is Empty </div>
        <?php
        }
        ?>
    </main>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Avito
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Laravel</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright
            AVITO
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        setTimeout(() => {
            document.querySelector(".js-alert").style.display = "none";
        }, 3000)
        let fav = document.querySelectorAll(".favorite");

        for (let i = 0; i < fav.length; i++) {
            fav[i].addEventListener("click", (elm) => {
                fav[i].classList.toggle("red");
            });
        }
        exampleForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            const formData = new FormData(exampleForm);
            formData.append('id', 2);

            fetch('file.php', {
                    method: 'POST',
                    body: formData, // Pass formData directly as the body
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error sending data:', error);
                });
        });
    </script>
</body>

</html>