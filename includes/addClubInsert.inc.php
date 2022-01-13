<!DOCTYPE html>
<html lang="en">
 
    <body>
        <center>
            <?php
                include_once 'dbh.inc.php';
                
                // Taking all the values from the form data(input)
                if(!empty($_POST['clubName'])) {
                    global $clubName;
                    $clubName = $_POST['clubName'];
                                   
                    $contact= $_POST['contact'];
                    if (empty($contact))
                    {
                        header("location: ../addClub.php?error=emptycontact");
                        exit();
                    }

                    $description= $_POST['description'];
                    if (empty($description))
                    {
                        header("location: ../addClub.php?error=emptydescription");
                        exit();
                    }
                    // Find the clubID for the clubSuggestionsClub
                        $sql = "INSERT INTO clubs (clubsTitle, clubsDescription, clubsContactInfo) VALUES ('$clubName', '$description', '$contact')";
                        if(mysqli_query($conn, $sql)){
                            header("location: ../addClub.php?error=none");    
                            exit();    
                        } else{
                            echo "ERROR: Hush! Sorry $sql. " 
                            . $conn->error;
                        }
            } else {
                header("location: includes/addClub.php?error=emptyclubName");
                exit();
            }
                $conn->close();
            ?>
        </center>
    </body>
  
</html>
