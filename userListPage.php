<?php include_once 'header.php'?>

    <br>
    <br>
    <div class="container">
    <h2>Users</h2>

    <br>
    <br>
    <br>
    <br>

    <!-- Using a select query to fetch data from the databse and then displaying it in an 
    HTML table.-->
    <table table id="userTable">
        <tr>
            <th width="40%">Username</th>
            <th width="40%">Delete User</th>
        </tr>
    
        <?php
        // fetch data of users from database
        $records = mysqli_query($conn,"SELECT usersID, usersUid FROM users"); 
        while($data = mysqli_fetch_array($records)) {
            if($data['usersUid'] != $_SESSION["userUid"]) {
        ?>

        <tr>
            <!-- There are two types of account one is teacher and one is student. Both accounts
        can view and search users. While teachers can delete and make new invitation codes. -->
            <td><?php echo $data['usersUid']; ?></td>
            <!-- Checking whether the user is a student or a teacher. -->
            <?php 
                if ($_SESSION["userRole"] == "Student") {
                echo "<td>----</td>";
                }
            ?>

            <?php 
                if ($_SESSION["userRole"] == "Teacher") {
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
        // This is where the error handling takes place. 
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "errorUserDelete":
                    echo "<br><p class='container'><font color=red>Encountered error in deleting user.</font></p>";
                    break;
                case "none":
                    echo "<br><p class='container'><font color=green>User was deleted successfully!</font> </p> ";
            }
        }
    ?>
    
    
    <br>
    <br>


    <!--Created a search for the user list page.-->
    <form action="searchUser.php" method="POST" class="userSearch">
        <div class="row">
            <input type="text" name="search" class="form-control" placeholder="Search user..." ></input><br>
            <button type="submit" class="btn-light" name="user-search">Search</button>
        </div>
    </form>

    
    <!-- Only teachers can create new invitation codes -> which means new account. -->
    <?php
        if ($_SESSION["userRole"] == "Teacher") {
            echo "<a href=\"createInvitationCode.php\"><input type=\"button\" value=\"Create Invitation Code\" class=\"addClub\"></a>";
        }
    ?>
    <br>
    <br>
    <br>
    <hr>
    <br>

    <?php include_once 'footer.php'?>
               
