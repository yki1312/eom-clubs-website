<?php include_once 'header.php'?>

<!-- This is where the search sting comes in when pressed the search button.-->
<div class="container">
    <h2>Search User Page</h2>
    <br>
    <?php
        if(isset($_POST['user-search'])) { // The if statement checks whether the person has hit search. 
            // This line trims extra spaces.
            $search = trim($_POST['search']);
            if($_SESSION["userUid"] != $_POST['search']) {
                // Searching for users with name, having string entered by user.
                $sql = "SELECT * FROM users WHERE usersUid LIKE '%$search%'"; 
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);
            } else {
                $queryResult = 0;
            }

            /* 
             * If the search result is found it will display it on the page 
             * else proper error will be shown to the user.
             */          
            if ($queryResult > 0 ) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<table 'table id=userTable' class='table-sm'>
                            <tr>
                                <th 'width=50%'>Username</th> 
                                <td> ". $row["usersUid"] . " </td> <br>
                            </tr>

                        </table>"; 
                }
            } else {
                echo "There are no results matching your search! Please try again!";
            }
        }

    ?>
</div>

<br>
<br>

<a href="userListPage.php"><input type="button" class="btn btn-secondary" value="<- Back to User List"></a>

<br>
<br>
<br>
<br>
<br>
<br>
<?php include_once 'footer.php'; ?>

</body>
</html>