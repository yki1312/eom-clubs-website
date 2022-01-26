<!-- inserts logo, navigation bar, and opens database connection -->
<?php include_once 'header.php'; ?>
<section class="p-1">
    <div class="container">
        <!-- HTML form that allows user to input an invitation code -->
        <h5> Don't have an account? </h5>
        <form action="includes/enterInvCode.inc.php" method="post">
            <label for="invCode" class="form-label">Enter invitation code:</label>
            <input type="text" name="invCode" placeholder="Invitation Code..." required class="form-control">
            <br />
            <div class="row">
                <button type="submit" name="submit" class="btn-light">Submit</button>
            </div>
        </form>
        <br />
        <?php
        // error messages for invalid invitation codes
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "emptyinput":
                    echo "<p class=\"errorColour\">Fill in the field!</p>";
                    break;
                case "invalidinvcode":
                    echo "<p class=\"errorColour\">Invitation codes are 11 numbers.</p>";
                    break;
                case "nomatchinginvcode":
                    echo "<p class=\"errorColour\">Invitation code does not exist!</p>";
                    break;
                case "usedinvcode":
                    echo "<p> class=\"errorColour\"Invitation code has already been used!</p>";
                    break;
                case "expiredinvcode":
                    echo "<p class=\"errorColour\">Invitation code has already expired!</p>";
                    break;
                case "smtmfailed":
                case "exefailed":
                    echo "<p class=\"errorColour\">Something went wrong! Please try again.</p>";
            }
        }
        ?>
    </div>
</section>
<!-- inserts footer and closes database connection -->
<?php include_once 'footer.php'; ?>