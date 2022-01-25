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
?>
<section class="p-1">
    <div class="container">
        <div class="row">
            <a href="clubPage.php?club=<?php echo $clubsID; ?>" class="btn btn-light col">Back to View Mode</a>
        </div>
        <br />
        <form action="includes/clubPageUser.inc.php" method="post" id="basicInfo">
            <div><label for="clubTitle" class="form-label">Club Title</label></div>
            <div class="row">
                <div class="col-10"><input name="clubTitle" type="text" class="form-control" value="<?php echo $title; ?>" required></div>
                <button type="submit" name="delete" class="col btn-light">Delete Club</button>
            </div>
            <br />
            <div><label for="clubDescription" class="form-label">Club Description</label></div>
            <div><textarea name="clubDescription" class="form-control" rows="6"><?php echo $description; ?></textarea></div>
            <br />
            <div><label for="clubContact" class="form-label">Contact Information</label></div>
            <div><textarea name="clubContact" class="form-control" rows="4"><?php echo $contact; ?></textarea></div>
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
        <form action="includes/clubPageUser.inc.php" method="post" enctype="multipart/form-data" id="media">
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
        </form>
        <br />
        <p>Currently uploaded image (updates after "Upload Image" is clicked):</p>
        <div class="d-flex justify-content-center align-content-start">
            <?php
            if (strlen($media) != 0) {
                echo "<img src=\"img/" . $media . "\" width=\"50%\" height=auto>";
            }
            ?>
        </div>
        <br />
        <br />
        <br />
        <div class="row" id="suggestionAndMember">
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
                echo "<br/>";
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
                        echo "<form action=\"includes/clubPageUser.inc.php\" method=\"post\">";
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-9\"><br/><p>" . $row["clubMembersName"] . "</p></div>";
                        echo "<input type=\"hidden\" name=\"memberID\" value=\"" . $row["clubMembersID"] . "\">";
                        echo "<input type=\"hidden\" name=\"clubID\" value=\"" . $row["clubMembersClub"] . "\">";
                        echo "<div class=\"col d-flex align-items-center justify-content-end\">";
                        echo "<button name=\"deleteMember\" type=\"submit\" class=\"btn-light\">Delete Member</button>";
                        echo "</div></div></form>";
                    }
                }
                ?>
                <br />
                <form action="includes/clubPageUser.inc.php" method="post">
                    <div class="row">
                        <div class="col-9"><input name="newMember" type="text" placeholder="Name..."></div>
                        <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
                        <div class="col d-flex align-items-center justify-content-end">
                            <button name="addMember" type="submit" class="btn-light">Add Member</button>
                        </div>
                    </div>
                </form>
                <br />
                <?php
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
        <div class="row">
            <a href="clubPage.php?club=<?php echo $clubsID; ?>" class="btn btn-light col">Back to View Mode</a>
        </div>
        <br />
    </div>
</section>
<?php include_once 'footer.php'; ?>