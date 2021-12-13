<!DOCTYPE html>
<html lang="en">

<head>
    <title> EoM Clubs Website </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" type="image/x-icon" href="Logos/finalDesigns/Favicon/favicon8.ico">

</head>

<body>
    <header style="background-color: MediumSeaGreen">
        <img src=Logos/finalDesigns/Logo_4_Edited.png alt="Logo" width="200px" style="padding-top: 10px;">
        <i>
            <h1 class="bannerText"> Welcome to EOM Clubs!</h1>
        </i>
    </header>


    <ul>
        <li class="dropdown">
            <a href="main_page.php" class="dropbtn">Clubs</a>
            <div class="dropdown-content">
                <a href="clubPages/exampleSubpage.html">First Club</a>
                <a href="#">Second Club</a>
                <a href="#">Third Club</a>
            </div>
        </li>
        <li><a href="suggestions.php">Suggestions Page</a></li>
        <li><a href="aboutEoM.html">EOM Clubs Page</a></li>
        <li class="dropdown">
            <a href="userSystem/login.html" class="dropbtn">Login</a>
            <div class="dropdown-content">
                <a href="userPages/profile.html">Your Profile</a>
                <a href="userPages/userList.html">User List</a>
            </div>
        </li>
    </ul>


    <br>
    <h2>Clubs:</h2>


    <div class="addClub">
        <a href="clubPages/exampleSubpageUser.html"><input type="button" value="Add a club +"></a>
    </div>



    <!--Create a search using CSS.-->
    <form class="search">
        <input type="text" name="search" onkeyup="searchFunction()" id="myInput" placeholder="Search...">
    </form>
    <br>

    <script>
        function searchFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>


    <!-- Created a date display to be output to the screen.-->
    <p id="demo" style="border:5px solid rgb(226, 132, 94)" class="date"></p>
    <script>
        const d = new Date();
        document.getElementById("demo").innerHTML = d.toDateString();
    </script>



    <?php
    #Connection Function
    function connect()
    {
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "draft_club";
        global $conn;
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    #Calling the connect function
    connect();

    #First query to database
    $sql = "SELECT Title FROM clubs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        #output data of each row
        while ($row = $result->fetch_assoc()) {
    ?>
            <!--li class="clubList" id="myInput"><a href="clubPages/exampleSubpage.html"> <//?php echo $row["Title"] ?></a></li><br>;-->
            <li class="clubList" id="li"><?php echo $row["Title"] ?></li><br>
    <?php
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>


    <br>
    <footer class="earlFooter">
        <h3>EARL OF MARCH SS</h3>
        <address style="padding: 15px;">
            4 The Parkway, Kanata, ON K2K 1Y4, <br>
            Phone (613) 592-3361 | Fax (613) 592-9501
        </address>
        <a href="mailto:earlofmarchss@ocdsb.ca">Email: earlofmarchss@ocdsb.ca</a>
    </footer>
</body>

</html>