<?php include_once 'header.php'; ?>

    <br>
    <br>
    <div class="container">
    <h2>Suggestions Page</h2>
    <br>

    <!-- This is the suggestions form where we ask the person to input their feedback for a specific club. 
    We show them the dropdown by using the SELECT query from the database to display all the clubs.-->
    <form action="includes/insert_sugg.inc.php" method="post">
        What club would you like to give feedback on?
        <select name="club_name">
            <option disabled selected>-- Select Club --</option>
            <?php
                $records = mysqli_query($conn, "SELECT clubsTitle FROM clubs");  // Use select query here 

                while($data = mysqli_fetch_array($records))
                {
                    echo "<option value='". $data['clubsTitle']."'>".$data['clubsTitle'] ."</option>"; // displaying data in option menu
                }    
            ?>  
        </select>
        <br>
        <br>
        
        
        <!-- Another thing to consider is that I have added character limit the suggestions box as the website
        may crash if there are an infinity number of characters allowed in the dialouge box. This is done 
        by using the maxlength atrribute.-->

        <label>Type Your Suggestion Here:</label><br>
        <br>
        <textarea cols="5" rows="40" class="form-control" name="comments" maxlength = "2000" id="textClub"></textarea><br>
        <input type="submit" class="btn btn-primary" name="button" value="Submit">
    </form>
    </div>


    <!-- This where the error handling occurs. There are 3 cases to consider - if the club slection is left empty
    if the suggestions box is left empty or if everything is okay. This is done by using case, switch, break -->

    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyclub":
                echo "<p> <font color=red>Select the club!</font></p>";
                break;
                case "emptysuggestion":
                echo "<p> <font color=red> Please input the suggestion dialog box.</font> </p>";
                break;
            case "none":
                echo "<p> <font color=green>You've successfully entered suggestion!</font> </p> ";
        }
    }
    ?>
    <br>
    <br>
    <br>


    <hr class="rounded">
    <br>

<?php include_once 'footer.php'; ?>