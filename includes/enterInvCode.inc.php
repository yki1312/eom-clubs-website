<?php
if (isset($_POST["submit"])) {

    $invCode = $_POST["invCode"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputInvCode($invCode) !== false) {
        header("location: ../enterInvCode.php?error=emptyinput");
        exit();
    }
    if (invalidInvCode($invCode) !== false) {
        header("location: ../enterInvCode.php?error=invaliduid");
        exit();
    }
    useInvCode($conn, $invCode);
} else {
    header("location: ../enterInvCode.php");
    exit();
}
