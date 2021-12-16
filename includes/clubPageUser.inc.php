<?php
if (isset($_POST["save"])) {

    $id = $_POST["clubID"];
    $title = trim($_POST["clubTitle"]);
    $description = trim($_POST["clubDescription"]);
    $contact = trim($_POST["clubContact"]);
    $media = $_POST["clubMedia"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputClubPage($id, $title)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=emptyinput");
        exit();
    }
    updateClubPage($conn, $id, $title, $description, $contact, $media);
} else if (isset($_POST["delete"])) {
    $id = $_POST["clubID"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    deleteClubPage($conn, $id);
} else {
    header("location: ../clubPageUser.php?club=" . $_POST["clubID"] . "&error=nosubmit"); // write an if statement on clubPageUser.php for this $_GET
    exit();
}
