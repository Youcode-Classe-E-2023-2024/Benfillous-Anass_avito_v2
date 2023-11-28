<?php
session_start();
include_once("../includes/getData.php");
$product = getData("announces");
$users = getData("users");
if ($_SESSION["user-email"] != "admin")
    header("location: ../index.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" /> <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

    <style>
        .product-card {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .product-cards {
            width: 100%;
        }

        .list-title {
            display: flex;
            justify-content: space-between;
        }

        .add-new {
            margin-right: 30px;
        }

        #usersSection {
            flex-direction: column;
            width: auto;
        }

        section {
            width: 100%;
        }

        .product-image {
            width: 80px;
            height: 80px;
        }

        .empty {
            text-align: center;
        }
    </style>
</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">

    <header>
        <!--Nav-->
        <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

            <div class="flex flex-wrap items-center">
                <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                    <a href="./dashboard.php" aria-label="Home">
                    <img src="https://www.avito.ma/phoenix-assets/imgs/layout/new-logo.svg">
                    </a>
                </div>

                <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                    <span class="relative w-full">
                        <input aria-label="search" type="search" id="search" placeholder="Search" class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                        <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                            <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                            </svg>
                        </div>
                    </span>
                </div>

                <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                    <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                        <li class="flex-1 md:flex-none md:mr-3">
                            <div class="relative inline-block">
                                <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> Hi, Admin <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg></button>
                                <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                    <input type="text" class="drop-search p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                                    <a href="../index.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-home fa-fw"></i> Home</a>
                                    <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                                    <div class="border border-gray-800"></div>
                                    <a href="../includes/log.php?logout=true" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
    </header>


    <main>

        <div class="flex flex-col md:flex-row">
            <nav aria-label="alternative nav">
                <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

                    <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                        <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                            <li class="mr-3 flex-1 nav-item" onclick="showProductSection()">
                                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                                    <i class="fas fa-list pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Products</span>
                                </a>
                            </li>
                            <li class="mr-3 flex-1 nav-item" onclick="showUsers()">
                                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                                    <i class="fa fa-user pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Users</span>
                                </a>
                            </li>
                            <li class="mr-3 flex-1 nav-item" onclick="showAnalyticsSection()">
                                <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                    <i class="fas fa-chart-area pr-0 md:pr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Analytics</span>
                                </a>
                            </li>
                        </ul>
                    </div>


                </div>
            </nav>
            <section>
                <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">


                    <div id="analyticsSection" class="container-fluid">
                        <div class="bg-gray-800 pt-3">
                            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                                <h1 class="font-bold pl-2">Analytics</h1>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Metric Card-->
                                <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink pr-4">
                                            <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                                        </div>
                                        <div class="flex-1 text-right md:text-center">
                                            <h2 class="font-bold uppercase text-gray-600">Total Revenue</h2>
                                            <p class="font-bold text-3xl">$3249 <span class="text-green-500"><i class="fas fa-caret-up"></i></span></p>
                                        </div>
                                    </div>
                                </div>
                                <!--/Metric Card-->
                            </div>
                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Metric Card-->
                                <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink pr-4">
                                            <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                                        </div>
                                        <div class="flex-1 text-right md:text-center">
                                            <h2 class="font-bold uppercase text-gray-600">Total Users</h2>
                                            <p class="font-bold text-3xl">249 <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></p>
                                        </div>
                                    </div>
                                </div>
                                <!--/Metric Card-->
                            </div>
                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Metric Card-->
                                <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink pr-4">
                                            <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                                        </div>
                                        <div class="flex-1 text-right md:text-center">
                                            <h2 class="font-bold uppercase text-gray-600">New Users</h2>
                                            <p class="font-bold text-3xl">2 <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></p>
                                        </div>
                                    </div>
                                </div>
                                <!--/Metric Card-->
                            </div>
                        

                        </div>
                        <div class="flex flex-row flex-wrap flex-grow mt-2">

                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Graph Card-->
                                <div class="bg-white border-transparent rounded-lg shadow-xl">
                                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                        <h class="font-bold uppercase text-gray-600">Graph</h>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                                        <script>
                                            new Chart(document.getElementById("chartjs-7"), {
                                                "type": "bar",
                                                "data": {
                                                    "labels": ["January", "February", "March", "April"],
                                                    "datasets": [{
                                                        "label": "Page Impressions",
                                                        "data": [10, 20, 30, 40],
                                                        "borderColor": "rgb(255, 99, 132)",
                                                        "backgroundColor": "rgba(255, 99, 132, 0.2)"
                                                    }, {
                                                        "label": "Adsense Clicks",
                                                        "data": [5, 15, 10, 30],
                                                        "type": "line",
                                                        "fill": false,
                                                        "borderColor": "rgb(54, 162, 235)"
                                                    }]
                                                },
                                                "options": {
                                                    "scales": {
                                                        "yAxes": [{
                                                            "ticks": {
                                                                "beginAtZero": true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Graph Card-->
                                <div class="bg-white border-transparent rounded-lg shadow-xl">
                                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                        <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                                        <script>
                                            new Chart(document.getElementById("chartjs-0"), {
                                                "type": "line",
                                                "data": {
                                                    "labels": ["January", "February", "March", "April", "May", "June", "July"],
                                                    "datasets": [{
                                                        "label": "Views",
                                                        "data": [65, 59, 80, 81, 56, 55, 40],
                                                        "fill": false,
                                                        "borderColor": "rgb(75, 192, 192)",
                                                        "lineTension": 0.1
                                                    }]
                                                },
                                                "options": {}
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Graph Card-->
                                <div class="bg-white border-transparent rounded-lg shadow-xl">
                                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                        <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                                    </div>
                                    <div class="p-5">
                                        <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                                        <script>
                                            new Chart(document.getElementById("chartjs-1"), {
                                                "type": "bar",
                                                "data": {
                                                    "labels": ["January", "February", "March", "April", "May", "June", "July"],
                                                    "datasets": [{
                                                        "label": "Likes",
                                                        "data": [65, 59, 80, 81, 56, 55, 40],
                                                        "fill": false,
                                                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                                                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                                                        "borderWidth": 1
                                                    }]
                                                },
                                                "options": {
                                                    "scales": {
                                                        "yAxes": [{
                                                            "ticks": {
                                                                "beginAtZero": true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Graph Card-->
                                <div class="bg-white border-transparent rounded-lg shadow-xl">
                                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                        <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                                    </div>
                                    <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                                        <script>
                                            new Chart(document.getElementById("chartjs-4"), {
                                                "type": "doughnut",
                                                "data": {
                                                    "labels": ["P1", "P2", "P3"],
                                                    "datasets": [{
                                                        "label": "Issues",
                                                        "data": [300, 50, 100],
                                                        "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
                                                    }]
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!--/Graph Card-->
                            </div>

                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Table Card-->
                                <div class="bg-white border-transparent rounded-lg shadow-xl">
                                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                        <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                                    </div>
                                    <div class="p-5">
                                        <table class="w-full p-5 text-gray-700">
                                            <thead>
                                                <tr>
                                                    <th class="text-left text-blue-900">Name</th>
                                                    <th class="text-left text-blue-900">Side</th>
                                                    <th class="text-left text-blue-900">Role</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Obi Wan Kenobi</td>
                                                    <td>Light</td>
                                                    <td>Jedi</td>
                                                </tr>
                                                <tr>
                                                    <td>Greedo</td>
                                                    <td>South</td>
                                                    <td>Scumbag</td>
                                                </tr>
                                                <tr>
                                                    <td>Darth Vader</td>
                                                    <td>Dark</td>
                                                    <td>Sith</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <p class="py-2"><a href="#">See More issues...</a></p>

                                    </div>
                                </div>
                                <!--/table Card-->
                            </div>

                            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                                <!--Advert Card-->
                                <div class="bg-white border-transparent rounded-lg shadow-xl">
                                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                        <h2 class="font-bold uppercase text-gray-600">Advert</h2>
                                    </div>
                                    <div class="p-5 text-center">


                                        <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CK7D52JJ&placement=wwwtailwindtoolboxcom" id="_carbonads_js"></script>


                                    </div>
                                </div>
                                <!--/Advert Card-->
                            </div>


                        </div>
                    </div>


                    <div id="productSection" style="display: none;">
                        <div class="bg-gray-800 pt-3">
                            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-white list-title">
                                <h1 class="font-bold pl-2 text-2xl">Products</h1>
                                <a href="../includes/handelForm.php?admin=true" class="add-new">Add New Product</a>
                            </div>
                        </div>


                        <!-- Inside the main section, after the analytics cards -->
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6 product-cards">
                            <!--Product List-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <ul class="p-5">
                                    <?php
                                    foreach ($product as $announce) {

                                    ?>
                                        <li class="mb-4 product-card">
                                            <p><?php echo $announce["id"] ?></p>
                                            <?php echo '<img class="product-image" src="data:image/jpeg;base64,' . base64_encode($announce["img"]) . '" alt="Uploaded Image">'; ?>
                                            <h3 class="font-bold text-xl mb-2"><?php echo $announce["title"] ?></h3>
                                            <p class="text-gray-700 mb-2"><?php echo $announce["descri"] ?></p>
                                            <p class="text-gray-700">User: John Doe</p>
                                            <p class="text-xl font-bold text-purple-500"><?php echo $announce["price"] ?></p>
                                            <a href="../edit.php/?id=<?php echo $announce["id"]; ?>&admin=true" class="btn btn-primary">Edit</a>
                                            <form action="../includes/delete.php/?id=<?php echo $announce["id"]; ?>&admin=true" method="post">
                                                <button>delete</button>
                                            </form>
                                        </li>

                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (count($product) == 0) {
                                    ?>
                                        <div class="empty"> the List is Empty </div>
                                    <?php
                                    }
                                    ?>
                                    <!-- Add more products as needed -->

                                </ul>
                                <div class="flex justify-center">
                                    <a href="../index.php?admin=true" class="bg-purple-500 text-white px-4 py-2 rounded-md">Back to Home</a>
                                </div>
                            </div>
                            <!--/Product List-->
                        </div>
                    </div>

                    <div id="usersSection" style="display: none;">
                        <div class="bg-gray-800 pt-3">
                            <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-white list-title">
                                <h1 class="font-bold pl-2 text-2xl">Users</h1>
                                <button class="add-new">Add New User</button>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6 product-cards">
                            <!--User List-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <ul class="p-5">
                                    <?php
                                    foreach ($users as $user) {

                                    ?>
                                        <li class="mb-4 product-card">
                                            <p class="text-gray-700 mb-2"> <?php echo $user["id"] ?> </p>
                                            <img src="https://www.avito.ma/phoenix-assets/imgs/layout/new-logo.svg">
                                            <h3 class="font-bold text-xl mb-2"> <?php echo $user["username"] ?> </h3>
                                            <p class="text-gray-700">User: John Doe</p>
                                            <p class="text-xl font-bold text-purple-500">$99.99</p>
                                            <a href="../includes/editProfile.php?id=<?php echo $user["id"]; ?>">edit</a>
                                            <a href="../includes/deleteProfile.php?id=<?php echo $user["id"]; ?>">delete</a>
                                        </li>
                                    <?php } ?>

                                </ul>
                                <div class="flex justify-center">
                                    <button class="bg-purple-500 text-white px-4 py-2 rounded-md" onclick="showAnalyticsSection()">Back to Analytics</button>
                                </div>
                            </div>
                            <!--/user List-->
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </main>




    <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }
        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        }

        let product = document.getElementById('productSection');
        let analytic = document.getElementById('analyticsSection');
        let user = document.getElementById('usersSection');

        function showProductSection() {
            product.style.display = 'block';
            analytic.style.display = 'none';
            user.style.display = 'none';

        }

        function showAnalyticsSection() {
            analytic.style.display = 'block';
            user.style.display = 'none';
            product.style.display = 'none';
        }

        function showUsers() {
            user.style.display = 'block';
            product.style.display = 'none';
            analytic.style.display = 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>