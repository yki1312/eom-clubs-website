    <!-- This is the header and we have included it as a separate file so that it is more 
    efficient since the header and the footer mainly repeat in every page. -->
    <?php include_once 'header.php'?>
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
        <input type="text" name="search" placeholder="Search..." ></input>
        <button type="submit" name="submit-search">Search</button>
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

        <!-- I added 2 images on the main page using the modal feature. -->
        
        <div style="display:flex;justify-content:flex-end;margin-top:auto;">
            
            <img id="myImg" src="img/Earl.png" alt="Earl of March Secondary School"  style="width:100%;max-width:300px">
            
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>

            <!-- This code block is executing the how to convert the image inside the model. 
            It also untilizes the alt text as the caption of the image. -->
            <script>
                // Get the modal
                var modal = document.getElementById("myModal");
                
                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("myImg");
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");
                img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
                }
                
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() { 
                modal.style.display = "none";
                }
            </script>
        </div>
    </section>


    <br>
    <br>
    <br>
    <br>
    <?php include_once 'footer.php'; ?>

</body>
</html>
