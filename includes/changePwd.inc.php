<?php
// checks the user is here through submitting the HTML form
if (isset($_POST["submit"])) {

    //creates variables containing user input
    $uid = $_POST["uid"];
    $pwd = trim($_POST["pwd"]);
    $newPwd = trim($_POST["newPwd"]);
    $rePwd = trim($_POST["rePwd"]);

    // opens database connection and inserts functions
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //checks if user input is empty
    if (emptyInputSignup($uid, $pwd, $newPwd, $rePwd) !== false) {
        header("location: ../changePwd.php?error=emptyinput");
        exit();
    }
    // checks if the username and password matches
    if (verifyPwd($conn, $uid, $pwd) !== true) {
        header("location: ../changePwd.php?error=incorrectpwd");
        exit();
    }
    // checks if password and confirm password matches
    if (pwdMatch($newPwd, $rePwd) !== true) {
        header("location: ../changePwd.php?error=pwddontmatch");
        exit();
    }
    // updates the password linked to the username in the database
    changePwd($conn, $uid, $newPwd);
} else {
    // redirects the user who's on this page when they're not supposed to to home page
    header("location: ../main_page.php");
    exit();
}
