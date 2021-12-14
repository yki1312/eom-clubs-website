<?php
include_once 'header.php';
if (!isset($_GET["invCode"]) && !isset($_GET["error"])) {
    header("location: enterInvCode.php?error=noinvcode");
}
?>
<section>
    <h1> Create an Account </h1>
    <form action="includes/createAccount.inc.php" method="post" class="flex-container-v">
        <label for="uid">Create your username:</label>
        <input type="text" name="uid" placeholder="Username..." required>
        <label for="pwd">Create your password:</label>
        <input type="password" name="pwd" placeholder="Password..." required>
        <label for="rePwd">Confirm your password:</label>
        <input type="password" name="rePwd" placeholder="Repeat Password..." required>
        <input type="hidden" name="invCode" value="<?php echo $_GET["invCode"]; ?>">
        <button type="submit" name="submit">Create Account</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyinput":
                echo "<p>Fill in all fields!</p>";
                break;
            case "invaliduid":
                echo "<p>Ensure your username contain the allowed characters!</p>";
                break;
            case "takenuid":
                echo "<p>Username is already taken!</p>";
                break;
            case "pwddontmatch":
                echo "<p>Passwords do not match!</p>";
                break;
            case "stmtfailed":
                echo "<p>Something went wrong! Please try again.</p>";
                break;
            case "none":
                echo "<p>Your account has been successfully created! <a href=\"login.php\">Login here.</a></p>";
        }
    }
    ?>
</section>

<?php include_once 'footer.php'; ?>