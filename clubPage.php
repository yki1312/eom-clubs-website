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
//write else statement here for error instructions
?>
<section class="flex-container-h">
    <div class="flex-container-v club-basic-info">
        <div class="flex-container-h-nmq">
            <h2 id="club-title"><?php echo $title; ?></h2>
            <?php
            if (isset($_SESSION["userUid"])) {
                echo "<a href=\"clubPageUser.php?club=" . $clubsID . "\"id=\"club-edit-button\">Edit Club Information</a>";
            }
            ?>
        </div>
        <div class="flex-container-v">
            <p><?php echo $description; ?></p>
        </div>
    </div>
    <div class="flex-container-v club-basic-info">
        <div class="flex-container-v">
            <h2>Contact Information</h2>
            <p><?php echo $contact; ?></p>
        </div>
        <div class="flex-container-v">
            <h2>Photo gallery</h2>
            <!-- delete style when done -->
            <div style="padding-top: 200px; border: 1px solid black"><?php echo $media; ?></div>
        </div>
    </div>
</section>
<!-- 
below should be signed in view only!
in php, echo js that stops displaying this? might display on view source on client side tho
-->
<?php
if (isset($_SESSION["userUid"])) {
    echo "<hr/>";
    echo "<section>";
    echo "<div class=\"flex-container-h\">";
    echo "<div class=\"flex-container-v club-suggestions\">";
    echo "<h2>Suggestions</h2>";
    echo "<ol class=\"flex-container-v\">";
    $sql = "SELECT clubSuggestionsContent, clubSuggestionsCreationTime FROM clubSuggestions WHERE clubSuggestionsClub=$clubsID ORDER BY clubSuggestionsID DESC;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><p>Written at: " . $row["clubSuggestionsCreationTime"] . " (UTC)</p><p>" . $row["clubSuggestionsContent"] . "</p></li>";
        }
    }
    //write else statement here for error instructions
    echo "</ol>";
    echo "</div>";
    echo "<div class=\"flex-container-v club-member-list\">";
    echo "<h2>Member List</h2>";
    echo "<ol class=\"flex-container-v\">";
    // SELECT COUNT(clubMembersID) FROM clubMembers WHERE clubMembersID=$clubsID
    $sql = "SELECT clubMembersName FROM clubMembers WHERE clubMembersClub=$clubsID ORDER BY clubMembersName;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row["clubMembersName"] . "</li>";
        }
    }
    //write else statement here for error instructions
    echo "</ol>";
    echo "</div>";
    echo "</div>";
    echo "</section>";
}
?>
<!--<section>
    <div class="flex-container-h">
        <div class="flex-container-v club-suggestions">
            <h2>Suggestions</h2>
            <ol class="flex-container-v">
                <?php /*
                $sql = "SELECT clubSuggestionsContent, clubSuggestionsCreationTime FROM clubSuggestions WHERE clubSuggestionsClub=$clubsID ORDER BY clubSuggestionsID DESC;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li><p>Written at: " . $row["clubSuggestionsCreationTime"] . " (UTC)</p><p>" . $row["clubSuggestionsContent"] . "</p></li>";
                    }
                }
                //write else statement here for error instructions
                */ ?>
            </ol>
        </div>
        <div class="flex-container-v club-member-list">
            <h2>Member List</h2>
            <ol class="flex-container-v">
                <?php /*
                // SELECT COUNT(clubMembersID) FROM clubMembers WHERE clubMembersID=$clubsID
                $sql = "SELECT clubMembersName FROM clubMembers WHERE clubMembersClub=$clubsID ORDER BY clubMembersName;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . $row["clubMembersName"] . "</li>";
                    }
                }
                //write else statement here for error instructions
                */ ?>
            </ol>
        </div>
    </div>
</section>-->
<?php include_once 'footer.php'; ?>