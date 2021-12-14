<?php
if (isset($_POST["submit"])) {

    $uid = trim($_POST["uid"]);
    $pwd = trim($_POST["pwd"]);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($uid, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $uid, $pwd);
} else {
    header("location: ../login.php");
    exit();
}
