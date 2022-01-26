<?php
// inserts logo, navigation bar, and opens database connection
include_once 'header.php';
// ensures the user is redirected from enter invitation code page and has a valid invitation code, if not, redirects to enter invitation code page
if (!isset($_GET["invCode"]) && !isset($_GET["error"])) {
    header("location: enterInvCode.php?error=noinvcode");
}
?>
<section class="p-1">
    <div class="container">
        <!-- HTML form that allows user to input username and password -->
        <h5> Create an Account </h5>
        <form action="includes/createAccount.inc.php" method="post">
            <label for="uid" class="form-label">Create your username:</label>
            <input type="text" name="uid" placeholder="Username..." required class="form-control">
            <label for="pwd" class="form-label">Create your password:</label>
            <input type="password" name="pwd" placeholder="Password..." required class="form-control">
            <label for="rePwd" class="form-label">Confirm your password:</label>
            <input type="password" name="rePwd" placeholder="Repeat Password..." required class="form-control">
            <input type="hidden" name="invCode" value='<?php echo $_GET["invCode"]; ?>'>
            <br />
            <div class="row">
                <button type="submit" name="submit" class="btn-light">Create Account</button>
            </div>
            <br />
        </form>
        <?php
        //error or success messages for creating an account
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "emptyinput":
                    echo "<p class=\"errorColour\">Fill in all fields!</p>";
                    break;
                case "invaliduid":
                    echo "<p class=\"errorColour\">Ensure your username contain the allowed characters!</p>";
                    break;
                case "takenuid":
                    echo "<p class=\"errorColour\">Username is already taken!</p>";
                    break;
                case "pwddontmatch":
                    echo "<p class=\"errorColour\">Passwords do not match!</p>";
                    break;
                case "stmtfailed":
                case "exefailed":
                    echo "<p class=\"errorColour\">Something went wrong! Please try again.</p>";
                    break;
                case "none":
                    echo "<p>Your account has been successfully created! <a href=\"login.php\">Login here.</a></p>";
            }
        }
        ?>
    </div>
</section>
<!-- inserts footer and closes database connection -->
<?php include_once 'footer.php'; ?>