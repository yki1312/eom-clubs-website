<?php
// checks the user is here through submitting the HTML form
if (isset($_POST["submit"])) {

    //creates variable containing user input
    $invCode = trim($_POST["invCode"]);

    // opens database connection and inserts function
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // checks if user input is empty
    if (emptyInputInvCode($invCode) !== false) {
        header("location: ../enterInvCode.php?error=emptyinput");
        exit();
    }
    // checks if the entered inv code only has number characters
    if (invalidInvCode($invCode) !== false) {
        header("location: ../enterInvCode.php?error=invalidinvcode");
        exit();
    }
    // checks if the entered invitation code exists in the database
    if (invCodeExists($conn, $invCode) !== true) {
        header("location: ../enterInvCode.php?error=nomatchinginvcode");
        exit();
    }
    // checks if the entered invitation code is already used to make another account
    if (usedInvCode($conn, $invCode) !== false) {
        header("location: ../enterInvCode.php?error=usedinvcode");
        exit();
    }
    // queries when the entered invitation code was created from the database
    $invCodeCreationTime = invCodeCreationTime($conn, $invCode);
    // checks if the entered invitation code was created within 24 hours
    if (expiredInvCode($conn, $invCodeCreationTime) !== false) {
        header("location: ../enterInvCode.php?error=expiredinvcode");
        exit();
    }
    // redirects the user to create an account 
    validInvCode($invCode);
} else {
    // redirects the user who's on this page when they're not supposed to to enter invitation code page 
    header("location: ../enterInvCode.php");
    exit();
}
