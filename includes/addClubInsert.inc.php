<?php
    include_once 'dbh.inc.php';
    
    // Fetching all the values from the form data(input)
    if(!empty($_POST['clubName'])) {
        global $clubName;
        global $contact;
        global $description;
        $clubName = $_POST['clubName'];                                
        $contact= $_POST['contact'];
        $description= $_POST['description'];
        
        $sql_query = "SELECT clubsTitle FROM clubs WHERE clubsTitle='$clubName'";
        $record = mysqli_query($conn, $sql_query);
        
        if (mysqli_num_rows($record) == 0) {
            $sql = "INSERT INTO clubs (clubsTitle, clubsDescription, clubsContactInfo) VALUES ('$clubName', '$description', '$contact')";
            if(mysqli_query($conn, $sql)){
                header("location: ../addClub.php?error=none");    
                exit();    
            } else {
                echo "There was an error inserting the club.";
                exit();
            }
        } else {
            header("location: ../addClub.php?error=clubExist");
            exit();
        }                

    } 
    $conn->close();
?>

