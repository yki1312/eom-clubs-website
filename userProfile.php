<?php include_once 'header.php'?>
        
        <br>
        <h2>Your Profile</h2>
        <br>

        <!--This needs to be so that other people cannot make changes to it.-->
        <form>
            <fieldset>
                <legend>Your credentials:</legend>
                <br>
                <br>
                <label for="yemail">Your username:</label><br>
                <br>
                <input type="email" id="yemail" name="yemail" value="Student one"><br>
                <br>
                <br>
                <label for="ypass">Your password:</label><br>
                <br>
                <input type="password" id="ypass" name="ypass" value="**********"><br><br>
                <p>Account Type: Student / Teacher</p>
                <br>
                <input type="button" value="Sign Out">
                <a href="changePassword.html"><input type="button" value="Change Password"></a>

            </fieldset>
        </form>
        



    </body>
</html>