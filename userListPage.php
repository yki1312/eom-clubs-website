<?php include_once 'header.php'?>

    <br>
    <br>
    <div class="container">
    <h2>Users</h2>

    <br>
    <br>

    <table table id="userTable">
        <tr>
            <th width="40%">Username</th>
            <th width="40%">Delete User</th>
        </tr>
    
        <?php
        $records = mysqli_query($conn,"SELECT usersID, usersUid FROM users"); // fetch data from database
        while($data = mysqli_fetch_array($records)) {
            if($data['usersUid'] != $_SESSION["userUid"]) {
        ?>

        <tr>
            <td><?php echo $data['usersUid']; ?></td>
            <?php 
                if ($_SESSION["userRole"] == "Student") {
                echo "<td>----</td>";
                }
            ?>

            <?php 
                if ($_SESSION["userRole"] == "teacher") {
                    echo "<td><a href=\"includes/deleteUser.inc.php?id=" . $data["usersID"] . "\">Delete</a></td>";
                }
            ?>
        </tr>	
        <?php
        }
        }
        ?>
    </table>
    </div>
    
    <?php
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "errorUserDelete":
                    echo "<p> <font color=red>Encountered error in deleting user.</font></p>";
                    break;
                case "none":
                    echo "<p> <font color=green>User was deleted successfully!</font> </p> ";
            }
        }
    ?>
    
    <!--Created a search for the user list page.-->
    <br>
    <br>

    <form class="userSearch">
        <input type="text" name="search" onkeyup="searchFunction()" id="myInput" placeholder="Search user...">
    </form>
    <br>

    <script>
        function searchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");
        
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; //I needed to search from the second row User Email! It was set to the first.
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                } else {
                tr[i].style.display = "none";
                }
            }
            }
        }
    </script>

    
    <?php
        if ($_SESSION["userRole"] == "teacher") {
            echo "<a href=\"createInvitationCode.php\"><input type=\"button\" value=\"Create Invitation Code\" class=\"addClub\"></a>";
        }
    ?>
    <br>
    <br>
    <br>
    <hr>
    <br>

    <?php include_once 'footer.php'?>
               
