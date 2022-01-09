<?php include_once 'header.php'?>
        
        <br>
        <h2>Your Profile</h2>
        <br>
    <?php
        $record = mysqli_query($conn,"SELECT usersInvCode FROM users WHERE usersId = {$_SESSION["userId"]}");
        if (mysqli_num_rows($record) == 1) {
            $row = mysqli_fetch_assoc($record);
            $newRecord = mysqli_query($conn,"SELECT invitationCodesAccountType FROM invitationCodes WHERE invitationCodesID={$row["usersInvCode"]}"); 
            if (mysqli_num_rows($newRecord) == 1) {
                $user_role = mysqli_fetch_assoc($newRecord);
            }
        } 
    ?>
        <!--This needs to be so that other people cannot make changes to it.-->
        <form> 
            <fieldset>
                <legend>Your credentials:</legend>
                <br>
                <br>
                <label for="ytext">Your username:</label><br>
                <br>
                <input type="text" id="ytext" name="ytext" value=<?php echo $_SESSION["userUid"]?> readonly><br>
                <br>
                <br>
                <label for="ypass">Your password:</label><br>
                <br>
                <input type="password" id="ypass" name="ypass" value="**********" readonly><br><br>
                <br>
                <label for="ytype">Account Type:</label><br>
                <br>
                <input type="text" id="ytype" name="ytype" value=<?php echo $user_role["invitationCodesAccountType"]?> readonly><br><br>
                <br>
                <a href="includes/logout.inc.php"><input type="button" value="Sign Out"></a>
                <a href="changePassword.html"><input type="button" value="Change Password"></a>
            </fieldset>
        </form>
        
    <?php include_once 'footer.php'?>

