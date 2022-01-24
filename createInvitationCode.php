<?php include_once 'header.php'?>

<!--This is the actual form where I ask the users who are TEACHERS to generate a new invitation code. -->
<div id="main_layout">
    <center>
        <h2>Create Invitation Code Page</h2>

        <p>Do you want to create a teacher or a student account?</p>

        <form>
            <input type="radio" id="student" name="acc_ty" value="Student">
            <label for="student">Student</label><br>
            <input type="radio" id="teacher" name="acc_ty" value="Teacher" checked>
            <label for="teacher">Teacher</label><br>
        </form>
        <!--Created a button which would output a random number and display on the screen-->
        <button type="button" onclick="randomCode()">Generate Invitation Code</button>
        <strong><p id="new_code"></p></strong>
        <strong><p id="result"></p></strong>

        <br>
        <br>

        <p>A newly created invitation code is valid for 24 hours and has a one time use.</p>
        <p>Teacher accounts will be able to create invitation codes and delete user accounts.</p>
    </center>
</div>

<!-- This is where the random generation of code occurs in the randomCode function. 
Since we are working in JS we must find a way for us to communicate to PHP to insert the new code in the 
database.-->
<script>
    function randomCode() {
        let code = Math.floor((Math.random() * 100000) + 10000);
        document.getElementById("new_code").innerHTML = code;

        let ele = document.getElementsByName("acc_ty");
        var i = 0;
        var result = "";
        for(i = 0; i < ele.length; i++) {
            if(ele[i].checked) {
               document.getElementById("result").innerHTML = ele[i].value;
               result = ele[i].value;
            }
        }
        
        // Here is the method we use to communicate to PHP using PHP AJAX functionality. 
        // We create a an XMLHttpRequest object and us conditions to verify what we have received. 
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const resp_obj = JSON.parse(this.responseText);        
                if(resp_obj.success == true) {
                    document.getElementById("main_layout").innerHTML = "<center> <p><font color=green> You've successfully created the invitation code! <br> <br> Invitation code: " + code + "<br> Account type : " + result + " </center> </font></p>";
                } else {
                    document.getElementById("main_layout").innerHTML = "<center> <p><font color=red> Error in invitation code generation, retry again. </font></p></center>";
                }
            }
        };
        // Here is where we specify what method to send the request, where to send the request and what 
        // would the content be.
        xhttp.open("GET", "includes/InsertInvCodeInDB.inc.php?code="+code+"&type="+result);
        xhttp.send();
    }
</script>

<br>
<br>

<?php include_once 'footer.php'?>