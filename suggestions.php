<?php include_once 'header.php'; ?>

    <br>
    <br>
    <div class="container">
    <h2>Suggestions Page</h2>
    <br>

    <!-- This is the suggestions form where we ask the person to input their feedback for a specific club. 
    We show them the dropdown of the different clubs by using the SELECT query from the database to display all the clubs.-->
    <form action="includes/insert_sugg.inc.php" method="post">
        What club would you like to give feedback on?
        <select name="club_name">
            <option disabled selected>-- Select Club --</option>
            <?php
                // Use select query here
                $records = mysqli_query($conn, "SELECT clubsTitle FROM clubs");   

                while($data = mysqli_fetch_array($records))
                {
                    // displaying data in option menu
                    echo "<option value='". $data['clubsTitle']."'>".$data['clubsTitle'] ."</option>";
                }    
            ?>  
        </select>
        <br>
        <br>
        
        
        <!-- Character limit is added in the suggestions box as the website may crash. This is done 
        by using the maxlength atrribute in textarea.-->

        <label>Type Your Suggestion Here:</label><br>
        <br>
        <textarea cols="5" rows="40" class="form-control" name="comments" maxlength = "2000" id="textClub"></textarea><br>
        <input type="submit" class="btn btn-primary" name="button" value="Submit">
    </form>
    </div>


    
    <!-- This where the error handling occurs. -->
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyclub":
                echo "<br><p class='container'><font color=red>Select the club!</font></p>";
                break;
            case "emptysuggestion":
                echo "<br><p class='container'><font color=red> Please input the suggestion dialog box.</font> </p>";
                break;
            case "none":
                echo "<br><p class='container'><font color=green>You've successfully entered suggestion!</font> </p> ";
                break;
            case "sqlStmtFailed":
            case "sqlExecFailed":
                echo "<br><p class='container'><font color=red>Sql Execution failed!</font> </p> ";
                break;
        }
    }
    ?>
    <br>
    <br>
    <br>


    <hr class="rounded">
    <br>

<?php include_once 'footer.php'; ?>