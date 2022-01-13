<!DOCTYPE html>
<html lang="en">
 
    <body>
        <center>
            <?php
                include_once 'dbh.inc.php';
                
                // Taking all the values from the form data(input)
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
                        
                    $sql = "INSERT INTO clubsuggestions (clubSuggestionsContent, clubSuggestionsClub) VALUES ('$comments', '$row[clubsID]')";                    
                    if(mysqli_query($conn, $sql)){
                        header("location: ../suggestions.php?error=none");
                        exit();
                    } else{
                        echo "There was an error inputting the code";
                    }
            } else {
                header("location: ../suggestions.php?error=emptyclub");
                exit();
            }
                $conn->close();
            ?>
        </center>
    </body>
  
</html>
