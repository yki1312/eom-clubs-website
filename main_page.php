    <!-- This is the header and we have included it as a separate file so that it is more 
    efficient since the header and the footer mainly repeat in every page. -->
    <?php include_once 'header.php'?>
    <div class="container">
    <br>

    <h2>Clubs</h2>

    <!-- This code check whether the user is logged in or not. The excecutes an if statement to show or 
    hide the Add a club button. This button is only accessible for users. -->
    <?php
       if (isset($_SESSION["userId"])) { 
    ?>
        <div class="addClub">
            <a href="addClub.php"><input type="button" value="Add a club +"></a>
        </div>
    <?php
    }
    ?>

    <!-- This form excecutes the search function and when the search button is pressed it takes you 
    to the search.php function where it searched for the keyword inputted by the user. -->
    <form action="search.php" method="POST" class="search-bar">
        <div class="row">
            <input type="text" name="search" class="form-control" placeholder="Search..." ></input><br><br>
            <button type="submit" class="btn-light" name="submit-search">Search</button>
        </div>
    </form>

    <!-- This is where the club list is displayed from the database using the SELECT query from the table
    called clubs. The club list is displayed in a ol format. -->
    <section>
        <div>
            <?php
                $sql = "SELECT clubsID, clubsTitle FROM clubs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div> 
                            <ol><a href=\"clubPage.php?club=" . $row["clubsID"] . "\">" . $row["clubsTitle"] ."</a><br></ol> 
                        </div>";                     
                    }
                } else {
                echo "";
                }
            ?>
        </div>
      
        
    <br>
    <br>
    <br>
    <br>
    </div>
    <?php include_once 'footer.php'; ?>

</body>
</html>
