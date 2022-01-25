<!-- people can currently go to clubs that don't exist via club=clubID that don't exisit in url
use an if statement to check if club in GET variable exisits as clubID first -->
<?php
include_once 'header.php';
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
                        <h1 class="col"><?php echo $title; ?></h1>
                    </div>
                    <div class="col-2">
                        <?php
                        if (isset($_SESSION["userUid"])) {
                            echo "<a href=\"clubPageUser.php?club=" . $clubsID . "\"id=\"club-edit-button\" class=\"btn btn-light\">Edit</a>";
                        }
                        ?>
                    </div>
                </div>
                <div style="white-space: pre-line;">
                    <?php echo $description; ?>
                </div>
                <br />
                <h5>Contact Information</h5>
                <div style="white-space: pre-line;">
                    <?php echo $contact; ?>
                </div>
            </div>
            <?php
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
    if (isset($_SESSION["userUid"])) {
        echo "<section class=\"p-5\">";
        echo "<div class=\"container\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-md\">";
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
<?php include_once 'footer.php'; ?>