<!DOCTYPE html>
<html lang="en">
 
    <body>
        <center>
            <?php
                include_once 'includes/dbh.inc.php';
                
                // Taking all the values from the form data(input)
                if(!empty($_POST['club_name'])) {
                    global $selected;
                    $selected = $_POST['club_name'];
                                   
                    $comments= $_POST['comments'];
                    if (empty($comments))
                    {
                        header("location: suggestions.php?error=emptysuggestion");
                        exit();
                    }
                    // Find the clubID for the clubSuggestionsClub
                    $sql_club_query = "SELECT clubsID FROM clubs WHERE clubsTitle='$selected'";
                    $record = mysqli_query($conn, $sql_club_query);
                    $row = mysqli_fetch_array($record);
                        
                    $sql = "INSERT INTO clubsuggestions (clubSuggestionsContent, clubSuggestionsClub) VALUES ('$comments', '$row[clubsID]')";                    
                    if(mysqli_query($conn, $sql)){
                        echo "<h3>data stored in a database successfully." 
                            . " Please browse your localhost php my admin" 
                            . " to view the updated data</h3>"; 
                        header("location: suggestions.php?error=none");
                        exit();
                    } else{
                        echo "ERROR: Hush! Sorry $sql. " 
                            . $conn->error;
                    }
            } else {
                header("location: suggestions.php?error=emptyclub");
                exit();
            }
                $conn->close();
            ?>
        </center>
    </body>
  
</html>