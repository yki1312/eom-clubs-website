    <?php include_once 'header.php'?>
    <br>
    <h2>Clubs:</h2>
    <?php
    if (isset($_SESSION["userId"])) { 
    ?>
        <div class="addClub">
            <a href="addClub.php"><input type="button" value="Add a club +"></a>
        </div>
    <?php
    }
    ?>


    <!--Create a search using CSS.-->
    <form class="search-bar">
        <input type="text" name="search" onkeyup="searchFunction()" id="myInput" placeholder="Search...">
    </form>
    <br>

    <script>
        function searchFunction() {
        // Declare variables
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
        }
    </script>

    <?php
    include_once 'includes/dbh.inc.php';

    #First query to database
    $sql = "SELECT clubsID, clubsTitle FROM clubs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        #output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>
        <ul id="myUL">
            <li><?php echo "<a href=\"clubPage.php?club=" . $row["clubsID"] . "\">" . $row["clubsTitle"] ."</a>"?></li>
        </ul>
    <?php
            }
        } else {
            echo "0 results";
        }
    ?>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include_once 'footer.php'; ?>

