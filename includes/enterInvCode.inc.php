<?php
if (isset($_POST["submit"])) {

    $invCode = $_POST["invCode"];
    //trim($invCode);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputInvCode($invCode) !== false) {
        header("location: ../enterInvCode.php?error=emptyinput");
        exit();
    }
    if (invalidInvCode($invCode) !== false) {
        header("location: ../enterInvCode.php?error=invalidinvcode");
        exit();
    }
    if (invCodeExists($conn, $invCode) !== true) {
        header("location: ../enterInvCode.php?error=nomatchinginvcode");
        exit();
    }
    if (usedInvCode($conn, $invCode) !== false) {
        header("location: ../enterInvCode.php?error=usedinvcode");
        exit();
    }
    /*    if (expiredInvCode($conn, $invCode) !== false){
        header("location: ../enterInvCode.php?error=expiredinvcode");
        exit();
    }*/
    useInvCode($invCode);
} else {
    header("location: ../enterInvCode.php");
    exit();
}
