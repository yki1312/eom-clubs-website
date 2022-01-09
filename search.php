<?php include_once 'header.php'?>

<h2>Search Page</h2>

<div class="clubs-container">
    <?php
        if(isset($_POST['submit-search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM clubs WHERE clubsTitle LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);

            if ($queryResult > 0 ) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='clubs-box'> 
                        <ol><a href=\clubPage.php?club=" . $row["clubsID"] . "\>" . $row["clubsTitle"] ."</a><br><ol> 
                    </div>"; 
                }
            } else {
                echo "There are no results matching your search!";
            }
        }

    ?>
</div>


<br>
<br>
<br>
<br>
<br>
<br>
<?php include_once 'footer.php'; ?>

</body>
</html>