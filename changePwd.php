<?php
include_once 'header.php';
if (!isset($_SESSION["userUid"])) {
    header("location: main_page.php");
}
?>
<section>
    <h1> Change Password </h1>
    <form action="includes/changePwd.inc.php" method="post" class="flex-container-v">
        <label for="pwd">Enter your current password:</label>
        <input type="password" name="pwd" placeholder="Password..." required>
        <label for="newPwd">Create your new password:</label>
        <input type="password" name="newPwd" placeholder="New Password..." required>
        <label for="rePwd">Confirm your new password:</label>
        <input type="password" name="rePwd" placeholder="Repeat Password..." required>
        <input type="hidden" name="uid" value="<?php echo $_SESSION["userUid"]; ?>">
        <button type="submit" name="submit">Change Password</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "nomatchinguid":
                echo "<p>No matching UID!</p>";
                break;
            case "emptyinput":
                echo "<p>Fill in all fields!</p>";
                break;
            case "pwddontmatch":
                echo "<p>Passwords do not match!</p>";
                break;
            case "exe7failed":
            case "stmt7failed":
                echo "<p>Something went wrong! Please try again.</p>";
                break;
            case "none":
                echo "<p>Your account has been successfully created! <a href=\"login.php\">Login here.</a></p>";
        }
    }
    ?>
</section>
<?php include_once 'footer.php'; ?>