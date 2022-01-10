<?php
if (isset($_POST["submit"])) {

    $uid = $_POST["uid"];
    $pwd = trim($_POST["pwd"]);
    $newPwd = trim($_POST["newPwd"]);
    $rePwd = trim($_POST["rePwd"]);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($uid, $pwd, $newPwd, $rePwd) !== false) {
        header("location: ../changePwd.php?error=emptyinput");
        exit();
    }
    if (verifyPwd($conn, $uid, $pwd) !== true) {
        header("location: ../changePwd.php?error=incorrectpwd");
        exit();
    }
    if (pwdMatch($newPwd, $rePwd) !== true) {
        header("location: ../changePwd.php?error=pwddontmatch");
        exit();
    }

    changePwd($conn, $uid, $newPwd);
} else {
    header("location: ../index.php");
    //change to main_page.php
    exit();
}
