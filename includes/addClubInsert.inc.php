<?php
    include_once 'dbh.inc.php';
    
    // Fetching all the values from the form data(input)
    if(!empty($_POST['clubName'])) {
        global $clubName;
        global $contact;
        global $description;
        $clubName = trim($_POST['clubName']);
        $contact= trim($_POST['contact']);
        $description= trim($_POST['description']);
        
        /* Checking if the club previously exists or not by searching for the club name 
        in the database. If it does then there will be an error displayed that the club already exists.
        */
        $sql_query = "SELECT clubsTitle FROM clubs WHERE clubsTitle='$clubName'";
        $record = mysqli_query($conn, $sql_query);
        
        /* Here also we need to use prepared statements to allow the use of        
        exceptions like " or ' or !. Else the suggestion would not be entered in the database.
        */
        if (mysqli_num_rows($record) == 0) {
            $sql = "INSERT INTO clubs (clubsTitle, clubsDescription, clubsContactInfo) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../addClub.php?error=sqlStmtFailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "sss", $clubName, $description, $contact);
            if (!mysqli_stmt_execute($stmt)) {
                header("location: ../addClub.php?error=sqlExecFailed");    
                exit();  
            };
            mysqli_stmt_close($stmt);
            header("location: ../addClub.php?error=none");    
            exit();                
        } else {
            header("location: ../addClub.php?error=clubExist");
            exit();
        }                

    } 
    $conn->close();
?>

