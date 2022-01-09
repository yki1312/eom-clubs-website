    <?php include_once 'header.php'?>
    <br>
    <h2>Clubs</h2>
    <?php
       if (isset($_SESSION["userId"])) { 
    ?>
        <div class="addClub">
            <a href="addClub.php"><input type="button" value="Add a club +"></a>
        </div>
    <?php
    }
    ?>


    <form action="search.php" method="POST" class="search-bar">
        <input type="text" name="search" placeholder="Search..." ></input>
        <button type="submit" name="submit-search">Search</button>
    </form>


    <div class="clubs-container">
        <?php
            $sql = "SELECT clubsID, clubsTitle FROM clubs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='clubs-box'> 
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
    <?php include_once 'footer.php'; ?>

</body>
</html>
