<?php
    include_once 'dbh.inc.php';
    
    // Taking all the values from the form data(input)
    if(!empty($_REQUEST["code"])) {
        global $inv_code;
        $inv_code = $_REQUEST["code"];              
        $type= $_REQUEST["type"];

        // Checking to see if the code exists or not.
        $sql_club_query = "SELECT invitationCodesID FROM InvitationCodes WHERE invitationCodesID='$inv_code'";
        $record = mysqli_query($conn, $sql_club_query);
        
        if (mysqli_num_rows($record) > 0) {
            echo json_encode(['success' => false]);
            exit();
        }
        // Here we are inserting the invitation code. And also checking whether the query is 
        // excecuted or gives an error.
        $sql = "INSERT INTO InvitationCodes (invitationCodesID, invitationCodesAccountType) VALUES ('$inv_code', '$type')";                    
        if(mysqli_query($conn, $sql)){
            echo json_encode(['success' => true]);
            exit();
        } else{
            echo json_encode(['success' => false]);
            exit();
        }
    } else {
        echo json_encode(['success' => false]);        
        exit();
    }
    $conn->close();
?>
