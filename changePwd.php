<?php
include_once 'header.php';
if (!isset($_SESSION["userUid"])) {
    header("location: index.php");
    //change this to main_page.php
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

</section>
<?php include_once 'footer.php'; ?>