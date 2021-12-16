<?php include_once 'header.php'; ?>

        <br>
        <br>
        <h2>Suggestions Page</h2>
        <br>

        <form action="insert_sugg.php" method="post">
            What club would you like to give feedback on?
            <select name="club_name">
                <option disabled selected>-- Select Club --</option>
                <?php
                    include_once 'includes/dbh.inc.php';

                    $records = mysqli_query($conn, "SELECT clubsTitle FROM clubs");  // Use select query here 

                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['clubsTitle']."'>".$data['clubsTitle'] ."</option>"; // displaying data in option menu
                    }    
                ?>  
            </select>
            <br>
            <br>
            
            <label>Type Your Suggestion Here:</label><br>
            <br>
            <textarea cols="5" rows="40" name="comments" id="textClub"></textarea><br>
            <input type="submit" name="button" value="Submit"/>
        </form>
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