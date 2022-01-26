<?php
// checks the user is here through submitting the HTML form
if (isset($_POST["submit"])) {

    //creates variables containing user input
    $uid = trim($_POST["uid"]);
    $pwd = trim($_POST["pwd"]);

    // opens database connection and inserts functions
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // checks if user input is empty
    if (emptyInputLogin($uid, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    // checks if username exists, then checks if the username and password matches
    // if both are true, creates $_SESSION variables
    loginUser($conn, $uid, $pwd);
} else {
    // redirects the user who's on this page when they're not supposed to to home page
    header("location: ../main_page.php");
    exit();
}
