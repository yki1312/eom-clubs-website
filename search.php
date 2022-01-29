<?php include_once 'header.php'?>

<div class="container">
    <h2>Search Page</h2>
    <br>
    <?php
        // The if statement checks whether the person has hit search.
        if(isset($_POST['submit-search'])) { 
            // This line trims spaces to keep it safe.
            $search = trim($_POST['search']); 
            // Searching for the keyword in the database like what is said in the search.
            $sql = "SELECT * FROM clubs WHERE clubsTitle LIKE '%$search%'"; 
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);

            /* Then when the search result is found it will display it on the page or it will throw an error of
            not finding anything according to the search result. */
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

<!-- Created the button to redirect to the main page.-->
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