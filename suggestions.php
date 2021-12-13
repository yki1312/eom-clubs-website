<!DOCTYPE html>
<html lang="en">
    <head>
        <title> EoM Clubs Website </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="icon" type="image/x-icon" href="Logos/finalDesigns/Favicon/favicon8.ico">

    </head>

    <body>
        <header style="background-color: MediumSeaGreen">
            <img src=Logos/finalDesigns/Logo_4_Edited.png alt="Logo" width="200px" style="padding-top: 10px;">
            <i><h1 class="bannerText"> Welcome to EOM Clubs!</h1></i>
        </header> 
        
        
        <ul>
            <li class="dropdown">
                <a href="main_page.php" class="dropbtn">Clubs</a>
                <div class="dropdown-content">
                    <a href="clubPages/exampleSubpage.html">First Club</a>
                    <a href="#">Second Club</a>
                    <a href="#">Third Club</a>
                </div>
            </li>
            <li><a href="suggestions.php">Suggestions Page</a></li>
            <li><a href="aboutEoM.html">EOM Clubs Page</a></li>
            <li class="dropdown">
                <a href="userSystem/login.html" class="dropbtn">Login</a>
                <div class="dropdown-content">
                    <a href="userPages/profile.html">Your Profile</a>
                    <a href="userPages/userList.html">User List</a>
                </div>
            </li>
        </ul> 
        <br>

        <br>
        <br>
        <h2>Suggestions Page</h2>
        <br>


        <form action="insert_sugg.php" method="post">
            What club would you like to give feedback on?
            <select name="club_name">
                <option disabled selected>-- Select Club --</option>
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

                    $records = mysqli_query($conn, "SELECT Title FROM clubs");  // Use select query here 

                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['Title']."'>".$data['Title'] ."</option>"; // displaying data in option menu
                    }    
                ?>  
            </select>
            <br>
            
            <label>Type Your Suggestion Here:</label><br>
            <br>
            <textarea cols="5" rows="40" name="comments" id="textClub"></textarea><br>
            <input type="submit" name="button" value="Submit"/>
        </form>

        <?php $conn->close();  // close connection ?>

        <br>
        <br>
        <br>


        <hr class="rounded">
        <br>

        <footer class="earlFooter">
            <h3>EARL OF MARCH SS</h3>
            <address style="padding: 10px;">
                4 The Parkway, Kanata, ON K2K 1Y4, <br>
                Phone (613) 592-3361 | Fax (613) 592-9501
            </address>
            <a href="mailto:earlofmarchss@ocdsb.ca">Email: earlofmarchss@ocdsb.ca</a>
        </footer>
        
        
        
    </body>
</html>