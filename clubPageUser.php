<?php
include_once 'header.php';
$clubsID = $_GET['club'];
if (!isset($_SESSION["userUid"])) {
    header("location: clubPage.php?club=" . $clubsID);
}
$sql = "SELECT clubsTitle, clubsDescription, clubsContactInfo, clubsMedia FROM clubs WHERE clubsID=$clubsID;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row["clubsTitle"];
        $description = $row["clubsDescription"];
        $contact = $row["clubsContactInfo"];
        $media = $row["clubsMedia"];
    }
}
//write else statement here for error instructions
?>
<section class="p-1">
    <div class="container">
        <div class="row">
            <a href="clubPage.php?club=<?php echo $clubsID; ?>" class="btn btn-light col">Back to View Mode</a>
        </div>
        <br />
        <form action="includes/clubPageUser.inc.php" method="post">
            <div><label for="clubTitle" class="form-label">Club Title</label></div>
            <div class="row">
                <div class="col-10"><input name="clubTitle" type="text" class="form-control" value="<?php echo $title; ?>" required></div>
                <button type="submit" name="delete" class="col btn-light">Delete Club</button>
            </div>
            <br />
            <div><label for="clubDescription" class="form-label">Club Description</label></div>
            <div><textarea name="clubDescription" class="form-control"><?php echo $description; ?></textarea></div>
            <br />
            <div><label for="clubContact" class="form-label">Contact Information</label></div>
            <div><textarea name="clubContact" class="form-control"><?php echo $contact; ?></textarea></div>
            <br />
            <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
            <div>
                <?php
                if (isset($_GET["error"])) {
                    switch ($_GET["error"]) {
                        case "emptyinput":
                            echo "<p>Fill the title of the club!</p>";
                            break;
                        case "errordeletingmedia":
                        case "stmt1failed":
                        case "exe1failed":
                        case "stmt2failed":
                        case "exe2failed":
                        case "stmt3failed":
                        case "exe3failed":
                            echo "<p>Something went wrong! Please try again.</p>";
                            break;
                        case "none":
                            echo "<p>Successfully updated.</p>";
                    }
                }
                ?>
            </div>
            <div class="row">
                <button type="submit" name="save" class="col btn-light">Save Changes</button>
            </div>
        </form>
        <br />
        <br />
        <br />
        <form action="includes/clubPageUser.inc.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <h5 class="col-2">Upload Image</h5>
                <div class="col"><input name="clubMedia" type="file" class="form-control"></div>
            </div>
            <br />
            <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
            <?php
            if (isset($_GET["error"])) {
                switch ($_GET["error"]) {
                    case "disallowedtype":
                        echo "<p>Ensure you're uploading a jpg, jpeg, or png file!</p>";
                        break;
                    case "errorupload":
                    case "stmt7failed":
                    case "exe7failed":
                        echo "<p>Something went wrong! Please try again.</p>";
                        break;
                    case "uploadsuccess":
                        echo "<p>Successfully uploaded.</p>";
                }
            }
            ?>
            <div class="row">
                <button type="submit" name="upload" class="btn-light">Upload Image</button>
            </div>
            <br />
            <p>Currently uploaded photo (updates when "Upload Image" is clicked):</p>
            <div class="d-flex justify-content-center align-content-start">
                <?php
                if (strlen($media) != 0) {
                    echo "<img src=\"img/" . $media . "\" width=\"50%\" height=auto>";
                }
                ?>
            </div>
        </form>
        <br />
        <br />
        <br />
        <div class="row">
            <div class="col-md">
                <h5>Suggestions</h5>
                <?php
                $sql = "SELECT * FROM clubSuggestions WHERE clubSuggestionsClub=$clubsID ORDER BY clubSuggestionsID DESC;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<form action=\"includes/clubPageUser.inc.php\" method=\"post\">";
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-10\"><br/><p>Written at: " . $row["clubSuggestionsCreationTime"] . "</p><p>" . $row["clubSuggestionsContent"] . "</p></div>";
                        echo "<input type=\"hidden\" name=\"suggestionID\" value=\"" . $row["clubSuggestionsID"] . "\">";
                        echo "<input type=\"hidden\" name=\"clubID\" value=\"" . $row["clubSuggestionsClub"] . "\">";
                        echo "<div class=\"col d-flex align-items-center justify-content-center\">";
                        echo "<button name=\"deleteSuggestion\" type=\"submit\" class=\"btn-light\">Delete</button>";
                        echo "</div></div></form>";
                    }
                }
                if (isset($_GET["error"])) {
                    switch ($_GET["error"]) {
                        case "stmt4failed":
                        case "exe4failed":
                            echo "<p>Something went wrong! Please try again.</p>";
                            break;
                        case "none1":
                            echo "<p>Successfully deleted.</p>";
                    }
                }
                ?>
            </div>
            <div class="col-md">
                <h5>Members</h5>
                <?php
                $sql = "SELECT * FROM clubMembers WHERE clubMembersClub=$clubsID ORDER BY clubMembersName;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        //button not on the same row as text???
                        echo "<br/>";
                        echo "<form action=\"includes/clubPageUser.inc.php\" method=\"post\">";
                        echo "<div class=\"row\"";
                        echo "<div class=\"col-10\"><p>" . $row["clubMembersName"] . "</p></div>";
                        echo "<input type=\"hidden\" name=\"memberID\" value=\"" . $row["clubMembersID"] . "\">";
                        echo "<input type=\"hidden\" name=\"clubID\" value=\"" . $row["clubMembersClub"] . "\">";
                        echo "<button name=\"deleteMember\" type=\"submit\" class=\"btn-light col\">Delete Member</button>";
                        echo "</div>";
                        echo "</form>";
                    }
                }
                ?>
                <form action="includes/clubPageUser.inc.php" method="post">
                    <div><input name="newMember" type="text" placeholder="Name..."></div>
                    <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
                    <button name="addMember" type="submit" class="btn-light">Add Member</button>
                </form>
                <?php
                // error messages for both add and delete members
                if (isset($_GET["error"])) {
                    switch ($_GET["error"]) {
                        case "emptyinputm":
                            echo "<p>Fill in the name!</p>";
                            break;
                        case "stmt5failed":
                        case "exe5failed":
                        case "stmt6failed":
                        case "exe6failed":
                            echo "<p>Something went wrong! Please try again.</p>";
                            break;
                        case "none2":
                        case "none3":
                            echo "<p>Successfully updated.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!--
<section>
    <form action="includes/clubPageUser.inc.php" method="post">
        <div class="flex-container-v">
            <div class="flex-container-v">
                <label for="clubTitle" class="club-label">Club Title</label>
                <div class="flec-container-h club-basic-info">
                    <input name="clubTitle" type="text" value="<?php echo $title; ?>" required>
                    <button type="submit" name="delete">Delete Club</button>
                </div>
                <br />
                <label for="clubDescription" class="club-label">Club Description</label>
                <textarea name="clubDescription"><?php echo $description; ?></textarea>
                <br />
                <label for="clubContact" class="club-label">Contact Information</label>
                <textarea name="clubContact"><?php echo $contact; ?></textarea>
                <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
            </div>
        </div>
        // fix this style; class="flex-container-h-nmq"
    <div style="float: right">
        <button type="submit" name="save">Save Changes</button>
    </div>
    <br />
    </form>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyinput":
                echo "<p>Fill the title of the club!</p>";
                break;
            case "errordeletingmedia":
            case "stmt1failed":
            case "exe1failed":
            case "stmt2failed":
            case "exe2failed":
            case "stmt3failed":
            case "exe3failed":
                echo "<p>Something went wrong! Please try again.</p>";
                break;
            case "none":
                echo "<p>Successfully updated.</p>";
        }
    }
    ?>
    <hr />
    <form action="includes/clubPageUser.inc.php" method="post" enctype="multipart/form-data">
        <label for="clubMedia" class="club-label">Upload Images</label>
        <input name="clubMedia" type="file">
        <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
        <button type="submit" name="upload">Upload Image</button>
        <?php
        if (strlen($media) != 0) {
            echo "<img src=\"img/" . $media . "\" width=\"300\" height=auto>";
        }
        ?>
    </form>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "disallowedtype":
                echo "<p>Ensure you're uploading a jpg, jpeg, or png file!</p>";
                break;
            case "errorupload":
            case "stmt7failed":
            case "exe7failed":
                echo "<p>Something went wrong! Please try again.</p>";
                break;
            case "uploadsuccess":
                echo "<p>Successfully uploaded.</p>";
        }
    }
    ?>
    <hr />
    <div class="flex-container-h">
        <div class="flex-container-v club-suggestions">
            <h2>Suggestions</h2>
            <ol class="flex-container-v">
                <?php
                $sql = "SELECT * FROM clubSuggestions WHERE clubSuggestionsClub=$clubsID ORDER BY clubSuggestionsID DESC;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>";
                        echo "<form action=\"includes/clubPageUser.inc.php\" method=\"post\">";
                        echo "<p>Written at: " . $row["clubSuggestionsCreationTime"] . "</p>";
                        echo "<p>" . $row["clubSuggestionsContent"] . "</p>";
                        echo "<input type=\"hidden\" name=\"suggestionID\" value=\"" . $row["clubSuggestionsID"] . "\">";
                        echo "<input type=\"hidden\" name=\"clubID\" value=\"" . $row["clubSuggestionsClub"] . "\">";
                        echo "<button name=\"deleteSuggestion\" type=\"submit\">Delete Suggestion</button>";
                        echo "</form>";
                        echo "</li>";
                    }
                }
                //write else statement here for error instructions
                if (isset($_GET["error"])) {
                    switch ($_GET["error"]) {
                        case "stmt4failed":
                        case "exe4failed":
                            echo "<p>Something went wrong! Please try again.</p>";
                            break;
                        case "none1":
                            echo "<p>Successfully updated.</p>";
                    }
                }
                ?>
            </ol>
        </div>
    <div class="flex-container-v club-member-list">
        <h2>Member List</h2>
        <ol class="flex-container-v">
            <?php
            $sql = "SELECT * FROM clubMembers WHERE clubMembersClub=$clubsID ORDER BY clubMembersName;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<form action=\"includes/clubPageUser.inc.php\" method=\"post\">";
                    echo "<span>" . $row["clubMembersName"] . "  </span>";
                    echo "<input type=\"hidden\" name=\"memberID\" value=\"" . $row["clubMembersID"] . "\">";
                    echo "<input type=\"hidden\" name=\"clubID\" value=\"" . $row["clubMembersClub"] . "\">";
                    echo "<button name=\"deleteMember\" type=\"submit\">Delete Member</button>";
                    echo "</form>";
                    echo "</li>";
                }
            }
            //use prepared statement here
            //write else statement here for error instructions
            ?>
            <li>
                <form action="includes/clubPageUser.inc.php" method="post">
                    <input name="newMember" type="text" placeholder="Name...">
                    <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
                    <button name="addMember" type="submit">Add Member</button>
                </form>
            </li>
            <?php
            // error messages for both add and delete members
            if (isset($_GET["error"])) {
                switch ($_GET["error"]) {
                    case "emptyinputm":
                        echo "<p>Fill in the name!</p>";
                        break;
                    case "stmt5failed":
                    case "exe5failed":
                    case "stmt6failed":
                    case "exe6failed":
                        echo "<p>Something went wrong! Please try again.</p>";
                        break;
                    case "none2":
                    case "none3":
                        echo "<p>Successfully updated.</p>";
                }
            }
            ?>
        </ol>
    </div>
    </div>
    <a href="clubPage.php?club=<?php echo $clubsID; ?>"><button style="float: right">Back to View Only Page</button></a>
    <br />
</section>-->
<?php include_once 'footer.php'; ?>