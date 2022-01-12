<?php include_once 'header.php'; ?>

<section>
    <h1> Don't have an account? </h1>
    <form action="includes/enterInvCode.inc.php" method="post" class="flex-container-v">
        <label for="invCode">Enter invitation code:</label>
        <input type="text" name="invCode" placeholder="Invitation Code..." required>
        <button type="submit" name="submit">Submit</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "emptyinput":
                echo "<p>Fill in the field!</p>";
                break;
            case "invalidinvcode":
                echo "<p>Invitation codes are 11 numbers.</p>";
                break;
            case "nomatchinginvcode":
                echo "<p>Invitation code does not exist!</p>";
                break;
            case "usedinvcode":
                echo "<p>Invitation code has already been used!</p>";
                break;
            case "expiredinvcode":
                echo "<p>Invitation code has already expired!</p>";
                break;
            case "smtmfailed":
            case "exefailed":
                echo "<p>Something went wrong! Please try again.</p>";
        }
    }
    ?>
</section>

<?php include_once 'footer.php'; ?>