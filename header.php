<?php
session_start();
?>
<!DOCTYPE html>
<html lang=en>

<head>
    <title> EoM Clubs Website </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>

<body>
    <header style="background-color: MediumSeaGreen">
        <img src=img/logo.png alt="Logo" width="200px" style="padding-top: 10px;">
        <h1 class="bannerText">Earl of March Clubs</h1>
    </header>
    <?php require 'includes/dbh.inc.php'; ?>
    <nav>
        <ul class="nav">
            <li class="dropdown">
                <a href="main_page.php" class="dropbtn">Clubs</a>
                <div class="dropdown-content">
                    <?php
                    $sql = "SELECT clubsID, clubsTitle FROM clubs";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<a href=\"clubPage.php?club=" . $row["clubsID"] . "\">" . $row["clubsTitle"] . "</a>";
                        }
                    }
                    ?>
                </div>
            </li>
            <li><a href="suggestions.php">Suggestions Page</a></li>
            <li><a href="EOMpage.php">EOM Clubs Page</a></li>

            <li class="dropdown">
                <?php
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
                ?>
            </li>
        </ul>
    </nav>
    <!-- Created a date display to be output to the screen.-->
    <p id="show_date" style="border:5px solid yellow" class="date"></p>
    <script>
        const d = new Date();
        document.getElementById("show_date").innerHTML = d.toDateString();
    </script>