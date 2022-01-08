<?php include_once 'header.php'?>
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
        xhttp.open("GET", "InsertInvCodeInDB.php?code="+code+"&type="+result);
        xhttp.send();
    }
</script>

<br>
<br>

<?php include_once 'footer.php'?>