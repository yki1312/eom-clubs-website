<?php
if (isset($_POST["submit"]) && isset($_GET["club"])) {
    $clubsID = $_GET["club"];
} else {
    header("location: clubPageUser.php?error=nosubmitorclubid"); // write an if statement on clubPageUser.php for this $_GET
    exit();
}
//use prepared statement when writing the php processing function!