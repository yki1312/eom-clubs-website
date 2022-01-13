<?php
include_once 'dbh.inc.php';

$user_id = $_GET['id']; // get id through query string

// fetch data from database
$record = mysqli_query($conn,"SELECT usersInvCode FROM users WHERE usersID = '$user_id'"); 
if (mysqli_num_rows($record) == 1) {
    //Fetched the invitiation code id for deleting it later
    $row = mysqli_fetch_assoc($record);
    // Delete the user from the db
    $del = mysqli_query($conn,"DELETE FROM users WHERE usersID = '$user_id'"); 
    if($del) {
        // now delete the corresponding invitation code entry from the db
        $newDel = mysqli_query($conn,"DELETE FROM invitationCodes WHERE invitationCodesID={$row["usersInvCode"]}"); 
        if($newDel) {
            mysqli_close($conn); // Close connection
            header("location:../userListPage.php?error=none"); // redirects to users page
            echo "User deleted successfully!"; // Display that the user is deleted. 
            exit;
        } else {
            mysqli_close($conn);
            header("location:../userListPage.php?error=errorInvDelete");
        }	 
    }
    else {
        mysqli_close($conn);
        header("location:../userListPage.php?error=errorUserDelete");
    }	 
}
else {
    mysqli_close($conn);
    echo "There was an error deleting the record."; // display error message if not deleted
    header("location:../userListPage.php?error=errorUserDelete");
    exit;
}


?>