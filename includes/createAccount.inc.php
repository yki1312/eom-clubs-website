<?php
// checks the user is here through submitting the HTML form
if (isset($_POST["submit"])) {

    //creates variables containing user input
    $uid = trim($_POST["uid"]);
    $pwd = trim($_POST["pwd"]);
    $rePwd = trim($_POST["rePwd"]);
    $invCode = $_POST["invCode"];

    // opens database connection and inserts functions
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // checks if user input is empty
    if (emptyInputSignup($uid, $pwd, $rePwd, $invCode) !== false) {
        header("location: ../createAccount.php?error=emptyinput&invCode=" . $invCode);
        exit();
    }
    // checks if entered username exists in the database
    if (uidExists($conn, $uid, false) !== false) {
        header("location: ../createAccount.php?error=takenuid&invCode=" . $invCode);
        exit();
    }
    // checks if the password and confirm password matches
    if (pwdMatch($pwd, $rePwd) !== true) {
        header("location: ../createAccount.php?error=pwddontmatch&invCode=" . $invCode);
        exit();
    }
    // inserts a new user into the database
    createUser($conn, $uid, $pwd, $invCode);
} else {
    // redirects the user who's on this page when they're not supposed to to home page
    header("location: ../enterInvCode.php");
    exit();
}
