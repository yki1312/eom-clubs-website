<?php
if (isset($_POST["save"])) {
    $id = $_POST["clubID"];
    $title = trim($_POST["clubTitle"]);
    $description = trim($_POST["clubDescription"]);
    $contact = trim($_POST["clubContact"]);
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if (emptyInputClubPage($id, $title)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=emptyinput#basicInfo");
        exit();
    }
    updateClubPage($conn, $id, $title, $description, $contact);
} else if (isset($_POST["upload"])) {
    $id = $_POST["clubID"];
    $file = $_FILES["clubMedia"];
    $fileName = $_FILES["clubMedia"]["name"];
    $fileTmpName = $_FILES["clubMedia"]["tmp_name"];
    $fileSize = $_FILES["clubMedia"]["size"];
    $fileError = $_FILES["clubMedia"]["error"];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            $fileNewName = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = '../img/' . $fileNewName;
            require_once 'dbh.inc.php';
            require_once 'functions.inc.php';
            if (move_uploaded_file($fileTmpName, $fileDestination) && deleteClubMedia($conn, $id) && updateClubMedia($conn, $id, $fileNewName)) {
                header("location: ../clubPageUser.php?club=" . $id . "&error=uploadsuccess#media");
            } else {
                header("location: ../clubPageUser.php?club=" . $id . "&error=errorupload#media");
                exit();
            }
        } else {
            header("location: ../clubPageUser.php?club=" . $id . "&error=errorupload#media");
            exit();
        }
    } else {
        header("location: ../clubPageUser.php?club=" . $id . "&error=disallowedtype#media");
        exit();
    }
} else if (isset($_POST["delete"])) {
    $id = $_POST["clubID"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    deleteClubPage($conn, $id);
} else if (isset($_POST["deleteSuggestion"])) {
    $suggestionID = $_POST["suggestionID"];
    $clubID = $_POST["clubID"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    deleteSuggestion($conn, $suggestionID, $clubID);
} else if (isset($_POST["addMember"])) {
    $id = $_POST["clubID"];
    $name = $_POST["newMember"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if (emptyInputClubPage($id, $name)) {
        header("location: ../clubPageUser.php?club=" . $id . "&error=emptyinputm#suggestionAndMember");
        exit();
    }
    addMember($conn, $name, $id);
} else if (isset($_POST["deleteMember"])) {
    $memberID = $_POST["memberID"];
    $clubID = $_POST["clubID"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    deleteMember($conn, $memberID, $clubID);
} else {
    header("location: ../clubPageUser.php?club=" . $_POST["clubID"] . "&error=nosubmit"); // write an if statement on clubPageUser.php for this $_GET
    exit();
}
