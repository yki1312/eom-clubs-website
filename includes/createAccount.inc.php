<?php
if (isset($_POST["submit"])) {

    $uid = trim($_POST["uid"]);
    $pwd = trim($_POST["pwd"]);
    $rePwd = trim($_POST["rePwd"]);
    $invCode = $_POST["invCode"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($uid, $pwd, $rePwd, $invCode) !== false) {
        header("location: ../createAccount.php?error=emptyinput");
        exit();
    }
    /*    if (invalidUID($uid) !== false) {
        header("location: ../createAccount.php?error=invaliduid");
        exit();
    }*/
    if (uidExists($conn, $uid) !== false) {
        header("location: ../createAccount.php?error=takenuid");
        exit();
    }
    if (pwdMatch($pwd, $rePwd) !== true) {
        header("location: ../createAccount.php?error=pwddontmatch");
        exit();
    }
    //function to ensure pwd is longer than whatever characters?

    createUser($conn, $uid, $pwd, $invCode);
} else {
    header("location: ../enterInvCode.php");
    exit();
}
