<!DOCTYPE html>
<html lang="en">
 
    <body>
        <center>
            <?php
    
                function connect() {
                    $servername = "localhost:3306";
                    $username = "root";
                    $password = "";
                    $dbname = "draft_club";
                    global $conn;
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    echo "Connected successfully <br><br>"; 
                }

                #Calling the connect function
                connect();                

                
                // Taking all the values from the form data(input)
                #$text_suggestion =  $_POST["textClub"];
                #$club = $_POST["club"];
                #echo "$text_suggestion, $club";

                if(!empty($_POST['club_name'])) {
                    global $selected;
                    $selected = $_POST['club_name'];
                    echo 'Your option selected' . $selected;
                }

                $comments= $_POST['comments'];

                $sql = "INSERT INTO clubsuggestions (Suggestion, Club) VALUES ('$comments', '$selected')";
                
                if(mysqli_query($conn, $sql)){
                    echo "<h3>data stored in a database successfully." 
                        . " Please browse your localhost php my admin" 
                        . " to view the updated data</h3>"; 
          
                } else{
                    echo "ERROR: Hush! Sorry $sql. " 
                        . $conn->error;
                }
                $conn->close();
            ?>
        </center>
    </body>
  
</html>
