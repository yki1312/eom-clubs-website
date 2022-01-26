<?php
// inserts logo, navigation bar, and opens database connection
include_once 'header.php';
// ensures the user is logged in, if not, redirects them to home page
if (!isset($_SESSION["userUid"])) {
    header("location: main_page.php");
}
?>
<section class="p-1">
    <div class="container">
        <!-- HTML form that allows user to input current password and new password -->
        <h5> Change Password </h5>
        <form action="includes/changePwd.inc.php" method="post">
            <label for="pwd" class="form-label">Enter your current password:</label>
            <input type="password" name="pwd" placeholder="Current Password..." required class="form-control">
            <label for="newPwd" class="form-label">Create your new password:</label>
            <input type="password" name="newPwd" placeholder="New Password..." required class="form-control">
            <label for="rePwd" class="form-label">Confirm your new password:</label>
            <input type="password" name="rePwd" placeholder="New Password..." required class="form-control">
            <input type="hidden" name="uid" value="<?php echo $_SESSION["userUid"]; ?>">
            <br />
            <div class="row">
                <button type="submit" name="submit" class="btn-light">Change Password</button>
            </div>
            <br />
        </form>
        <?php
        //error or success messages for changing password
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "emptyinput":
                    echo "<p class=\"errorColour\">Fill in all fields!</p>";
                    break;
                case "pwddontmatch":
                    echo "<p class=\"errorColour\">Passwords do not match!</p>";
                    break;
                case "incorrectpwd":
                    echo "<p class=\"errorColour\">Incorrect password!</p>";
                    break;
                case "exe7failed":
                case "stmt7failed":
                    echo "<p class=\"errorColour\">Something went wrong! Please try again.</p>";
            }
        }
        ?>
    </div>
</section>
<!-- inserts footer and closes database connection -->
<?php include_once 'footer.php'; ?>