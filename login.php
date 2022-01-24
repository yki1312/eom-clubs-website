<?php include_once 'header.php'; ?>

<section class="p-1">
    <div class="container">
        <h5> Login </h5>
        <form action="includes/login.inc.php" method="post">
            <label for="uid" class="form-label">Enter your username:</label>
            <input type="text" name="uid" placeholder="Username..." required class="form-control">
            <label for="pwd" class="form-label">Enter your password:</label>
            <input type="password" name="pwd" placeholder="Password..." required class="form-control">
            <br />
            <div class="row">
                <div class="col"><a href="enterInvCode.php" class="btn btn-light">Don't Have an Account?</a></div>
                <div class="col d-flex"><button type="submit" name="submit" class="btn-light col">Log In</button></div>
            </div>
            <br />
        </form>
        <?php
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "emptyinput":
                    echo "<p>Fill in all fields!</p>";
                    break;
                case "nomatchinguid":
                    echo "<p>Username does not exist.</p>";
                    break;
                case "incorrectpwd":
                    echo "<p>Incorrect username or password!</p>";
                    break;
                case "stmtfailed":
                case "exefailed":
                    echo "<p>Something went wrong! Please try again.</p>";
            }
        }
        ?>
    </div>
</section>

<?php include_once 'footer.php'; ?>