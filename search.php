<?php include_once 'header.php'?>



<!-- This is where the search sting comes in when pressed the search button.-->
<div class="container">
    <h2>Search Page</h2>
    <br>
    <?php
        if(isset($_POST['submit-search'])) { // The if statement checks whether the person has hit search.
            $search = trim($_POST['search']); // This line trims and characters which seem suspicious to keep it safe.
            $sql = "SELECT * FROM clubs WHERE clubsTitle LIKE '%$search%'"; // here it is searching for the keyword in the database like what is said in the search.
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);

            /* Then when the search result is found it will display it on the page or it will throw an error as to there were
            no search matching your result. */
            if ($queryResult > 0 ) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div> 
                        <ol><a href=\"clubPage.php?club=" . $row["clubsID"] . "\">" . $row["clubsTitle"] ."</a><br><ol> 
                    </div>"; 
                }
            } else {
                echo "There are no results matching your search! Please try again!";
            }
        }

    ?>
</div>

<br>
<br>
<a href="main_page.php"><input type="button" class="btn btn-secondary" value="<- Back to Main Page" class="addClub"></a>

<br>
<br>
<br>
<br>
<br>
<br>
<?php include_once 'footer.php'; ?>

</body>
</html>