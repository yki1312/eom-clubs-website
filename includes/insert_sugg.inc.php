<?php
    include_once 'dbh.inc.php';
    
    // Taking all the values from the form data(input) and validating whether they are empty or filled.
    if(!empty($_POST['club_name'])) {
        global $selected;
        $selected = $_POST['club_name'];
                        
        $comments= $_POST['comments'];
        if (empty($comments))
        {
            header("location: ../suggestions.php?error=emptysuggestion");
            exit();
        }
        // Find the clubID for the clubSuggestionsClub
        $sql_club_query = "SELECT clubsID FROM clubs WHERE clubsTitle='$selected'";
        $record = mysqli_query($conn, $sql_club_query);
        $row = mysqli_fetch_array($record);
        
        /* Excecute an insert query and run the prepared statements to ensure all the characters 
        are allowed.
        */
        $sql = "INSERT INTO clubsuggestions (clubSuggestionsContent, clubSuggestionsClub) VALUES (?, ?)";                    
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../suggestions.php?error=sqlStmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "si", $comments, $row["clubsID"]);
        if (!mysqli_stmt_execute($stmt)) {
            header("location: ../suggestions.php?error=sqlExecFailed");    
            exit();  
        };
        mysqli_stmt_close($stmt);
        
        header("location: ../suggestions.php?error=none");
        exit();
        
    } else {
        header("location: ../suggestions.php?error=emptyclub");
        exit();
    }
    $conn->close();
?>
