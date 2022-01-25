<?php include_once 'header.php'?>
        
        <br>
        <h2>Your Profile</h2>
        <br>
    <!-- This is the user profile page where first I have searched for the invitation codes and the
    corresponding account types for the user who is logged in. 
    This information is needed to display to the user logged in.-->
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
    
        <!-- This is the actual form of where the user sees its infomation displayed of its
        username, and their account type. -->
        <div class="container">
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
                <label for="ytype">Account Type:</label><br>
                <br>
                <input type="text" id="ytype" name="ytype" value=<?php echo $user_role["invitationCodesAccountType"]?> readonly><br><br>
                <br>
                <a href="includes/logout.inc.php"><input type="button" class="btn btn-outline-primary" value="Sign Out"></a>
                <a href="changePwd.php"><input type="button" class="btn btn-outline-primary" value="Change Password"></a>
            </fieldset>
        </form>
        </div>
        <br>
        <hr class="rounded">
        <br>

        
    <?php include_once 'footer.php'?>

