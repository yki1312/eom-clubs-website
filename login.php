<?php include_once 'header.php'; ?>

<section>
    <h1> Login </h1>
    <form action="includes/login.inc.php" method="post" class="flex-container-v">
        <div class="flex-container-v">
            <label for="uid">Enter your username:</label>
            <input type="text" name="uid" placeholder="Username..." required>
            <label for="pwd">Enter your password:</label>
            <input type="password" name="pwd" placeholder="Password..." required>
        </div>
        <div class="flex-container-h-nmq">
            <a href="enterInvCode.php" class="login-button">Don't Have an Account?</a>
            <button type="submit" class="login-button">Log In</button>
        </div>
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
        }
    }
    ?>
</section>

<?php include_once 'footer.php'; ?>