<?php include_once 'header.php'?>

    <br>
    <br>
    <h2>Users</h2>

    <br>
    <br>

    <table table id="userTable">
        <tr>
            <th>Sr.No.</th>
            <th width="60%">Username</th>
            <th>Delete User</th>
        </tr>
    
        <?php

        $records = mysqli_query($conn,"SELECT usersID, usersUid FROM users"); // fetch data from database

        while($data = mysqli_fetch_array($records))
        {
        ?>
        <tr>
            <td><?php echo $data['usersID']; ?></td>
            <td><?php echo $data['usersUid']; ?></td>
            <td><input type="button" value="Delete" onclick="deleteRow(this)"></td>
        </tr>	
        <?php
        }
        ?>
    </table>

    <!--To delete rows in a table using Html-->
    <script>
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("userTable").deleteRow(i);
        }
    </script>

    
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

    


    <a href="invitationCode.html"><input type="button" value="Create Invitation Code" class="addClub"></a>

    
    <br>
    <br>
    <br>
    <hr>
    <br>

    <?php include_once 'footer.php'?>
               

    </body>
</html>