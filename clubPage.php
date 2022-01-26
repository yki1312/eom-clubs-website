<?php
// inserts logo, navigation bar, and opens database connection
include_once 'header.php';
//queries information of a specific club from database
$clubsID = $_GET['club'];
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

<section class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="row">
                    <div class="col-10">
                        <!-- displays club title -->
                        <h1 class="col"><?php echo $title; ?></h1>
                    </div>
                    <div class="col-2">
                        <?php
                        // if logged in, displays edit button that redirects to edit club page/HTML form
                        if (isset($_SESSION["userUid"])) {
                            echo "<a href=\"clubPageUser.php?club=" . $clubsID . "\"id=\"club-edit-button\" class=\"btn btn-light\">Edit</a>";
                        }
                        ?>
                    </div>
                </div>
                <div style="white-space: pre-line;">
                    <!-- displays club description -->
                    <?php echo $description; ?>
                </div>
                <br />
                <!-- displays club contacts -->
                <h5>Contact Information</h5>
                <div style="white-space: pre-line;">
                    <?php echo $contact; ?>
                </div>
            </div>
            <?php
            // if media is uploaded to the database, displays club media
            if (strlen($media) != 0) {
                echo "<div class=\"col-md\">";
                echo "<img src=\"img/" . $media . "\" class=\"img-fluid\">";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</section>
<section>
    <?php
    // if logged in, displays suggestions and members 
    if (isset($_SESSION["userUid"])) {
        echo "<section class=\"p-5\">";
        echo "<div class=\"container\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-md\">";
        // queries for suggestions linked to the club and displays them
        echo "<h5>Suggestions</h5>";
        $sql = "SELECT clubSuggestionsContent, clubSuggestionsCreationTime FROM clubSuggestions WHERE clubSuggestionsClub=$clubsID ORDER BY clubSuggestionsID DESC;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div><br/><p>Written at: " . $row["clubSuggestionsCreationTime"] . "</p><p>" . $row["clubSuggestionsContent"] . "</p></div>";
            }
        }
        echo "<br/></div>";
        echo "<div class=\"col-md\">";
        // queries for members linked to the club and displays them
        echo "<h5>Members</h5>";
        echo "<ol>";
        $sql = "SELECT clubMembersName FROM clubMembers WHERE clubMembersClub=$clubsID ORDER BY clubMembersName;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<br/><li>" . $row["clubMembersName"] . "</li>";
            }
        }
        echo "</ol></div></div></div></section>";
    }
    ?>
</section>
<!-- inserts footer and closes database connection -->
<?php include_once 'footer.php'; ?>