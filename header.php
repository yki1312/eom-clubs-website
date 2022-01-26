<?php
session_start();
?>
<!DOCTYPE html>
<html lang=en>

<head>
    <title> EoM Clubs Website </title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="altstylesheet.css">
</head>

<body>
    <!-- add "fixed-top" in class -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: MediumSeaGreen">
        <div class="container">
            <a href="main_page.php" class="navbar-brand">
                <img src=img/logo.png alt="Logo" height="100" class="d-inline-block align-text-top">
            </a>
            <a href="main_page.php" class="navbar-text" style="color: rgb(235, 235, 65); text-decoration: none; font-weight: bold; font-size: 200%">Earl of March Clubs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php require 'includes/dbh.inc.php'; ?>
            <div id="navmenu" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" id="clubsDropdown" data-bs-toggle="dropdown" role="button" aria-expanded="false">Clubs</a>
                        <ul class="dropdown-menu" aria-labelledby="clubsDropdown">
                            <?php
                            $sql = "SELECT clubsID, clubsTitle FROM clubs";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<li><a class=\"dropdown-item\" href=\"clubPage.php?club=" . $row["clubsID"] . "\">" . $row["clubsTitle"] . "</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="suggestions.php" class="nav-link active">Suggestions</a></li>
                    <li class="nav-item"><a href="EOMpage.php" class="nav-link active">About Us</a></li>
                    <?php
                    if (isset($_SESSION["userUid"])) {
                        echo "<li class=\"nav-item dropdown\">";
                        echo "<a href=\"#\" class=\"nav-link active dropdown-toggle\" id=\"userDropdown\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">" . $_SESSION["userUid"] . "</a>";
                        echo "<ul class=\"dropdown-menu\" aria-labelledby=\"userDropdown\">";
                        echo "<li><a class=\"dropdown-item\" href=\"userProfile.php\">Your Profile</a></li>";
                        echo "<li><a class=\"dropdown-item\" href=\"userListPage.php\">User List</a></li>";
                        echo "<li><a class=\"dropdown-item\" href=\"includes/logout.inc.php\">Sign Out</a></li>";
                        echo "</ul></li>";
                    } else {
                        echo "<li class=\"nav-item\"><a href=\"login.php\" class=\"nav-link active\">Login</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--
    <header style="background-color: MediumSeaGreen">
        <img src=img/logo.png alt="Logo" width="200px" style="padding-top: 10px;">
        <center>
            <h1 class="bannerText">Earl of March Clubs</h1>
        </center>
    </header>
    <?php //require 'includes/dbh.inc.php'; 
    ?>
    <nav>
        <ul class="nav">
            <li class="dropdown">
                <a href="main_page.php" class="dropbtn">Clubs</a>
                <div class="dropdown-content">
                    <?php /*
                    $sql = "SELECT clubsID, clubsTitle FROM clubs";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<a href=\"clubPage.php?club=" . $row["clubsID"] . "\">" . $row["clubsTitle"] . "</a>";
                        }
                    }
                    */ ?>
                </div>
            </li>
            <li><a href="suggestions.php">Suggestions</a></li>
            <li><a href="EOMpage.php">About Us</a></li>

            <li class="dropdown">
                <?php /*
                if (isset($_SESSION["userUid"])) {
                    echo "<a href=\"userProfile.php\" class=\"dropbtn\">Logged In</a>";
                    echo "<div class=\"dropdown-content\">";
                    echo "<a href=\"userProfile.php\">Your Profile</a>";
                    echo "<a href=\"userListPage.php\">User List</a>";
                    echo "<a href=\"includes/logout.inc.php\">Log Out</a>";
                    echo "</div>";
                } else {
                    echo "<a href=\"login.php\" class=\"dropbtn\">Login</a>";
                }
                */ ?>
            </li>
        </ul>
    </nav>
    -->

    <!-- Created a date display to be output to the screen.-->
    <p id="show_date" style="border:2px solid yellow;padding: 0px 8px" class="date"></p>
    <script>
        const d = new Date();
        document.getElementById("show_date").innerHTML = d.toDateString();
    </script>
    <!-- Bootstrap v5.0 js bundle -->
    ​​<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>