<!-- Add delete club option -->
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
<section>
    <form action="includes/clubPageUser.inc.php">
        <div class="flex-container-h">
            <div class="flex-container-v club-basic-info">
                <label for="clubTitle" class="club-label">Club Title</label>
                <input name="clubTitle" type="text" value="<?php echo $title; ?>" required>
                <br />
                <label for="clubDescription" class="club-label">Club Description</label>
                <textarea name="clubDescription"><?php echo $description; ?></textarea>
            </div>
            <div class="flex-container-v club-basic-info">
                <label for="clubContact" class="club-label">Contact Information</label>
                <textarea name="clubContact"><?php echo $contact; ?></textarea>
                <br />
                <label for="clubMedia" class="club-label">Upload Images</label>
                <input name="clubMedia" type="file">
                <input name="clubID" type="hidden" value="<?php echo $clubsID; ?>">
            </div>
        </div>
        <!-- delete this link when done -->
        <a href="clubPage.php?club=<?php echo $clubsID; ?>">temp link to view only page</a>
        <!-- fix this style; class="flex-container-h-nmq" -->
        <div style="float: right">
            <button type="submit" name="delete">Delete Club</button>
            <button type="submit" name="save">Save Changes</button>
        </div>
    </form>
    <hr />
    <div class="flex-container-h">
        <div class="flex-container-v club-suggestions">
            <h2>Suggestions</h2>
            <ol class="flex-container-v">
                <?php
                $sql = "SELECT clubSuggestionsContent, clubSuggestionsCreationTime FROM clubSuggestions WHERE clubSuggestionsClub=$clubsID ORDER BY clubSuggestionsID DESC;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li><p>Written at: " . $row["clubSuggestionsCreationTime"] . " (UTC)</p><p>" . $row["clubSuggestionsContent"] . "</p><button type=\"button\">Delete Suggestion</button> </li>";
                    }
                }
                //button onclick, delete row from suggestion table, delete <li> from html
                //write else statement here for error instructions
                ?>
            </ol>
        </div>
        <div class="flex-container-v club-member-list">
            <h2>Member List</h2>
            <ol class="flex-container-v">
                <?php
                $sql = "SELECT clubMembersName FROM clubMembers WHERE clubMembersClub=$clubsID ORDER BY clubMembersName;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . $row["clubMembersName"] . "<button type=\"button\">Delete Member</button></li>";
                    }
                }
                //use prepared statement here
                //button onclick, delete row from member table, delete <li> from html
                //write else statement here for error instructions
                ?>
                <li><input name="newMember" type="text" placeholder="Name..."><button type="button">Add Member</button></li>
                <!-- onclick: insert row into database + add the same html line again -->
            </ol>
        </div>
        <!-- placement of save changes button might be confusing, think of a better layout -->
    </div>
</section>
<?php include_once 'footer.php'; ?>