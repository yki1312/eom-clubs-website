<?php include_once 'header.php'?>
<h2>Create Invitation Code Page</h2>

<p>Do you want to create a teacher or a student account?</p>

<form>
    <input type="radio" id="student" name="acc_ty" value="Student">
    <label for="student">Student</label><br>
    <input type="radio" id="teacher" name="acc_ty" value="Teacher" checked>
    <label for="teacher">Teacher</label><br>
</form>

<script>
    function randomCode() {
        let code = Math.floor((Math.random() * 100000) + 10000);
        document.getElementById("new_code").innerHTML = code;
        document.getElementById("codeDemo").innerHTML = "The generated invitation code is " + code;

        var ele = document.getElementsByName('acc_ty');
            
        for(i = 0; i < ele.length; i++) {
            if(ele[i].checked)
            document.getElementById("result").innerHTML = "Account Type: "+ele[i].value;
        }
    }
</script>


<br>

<!--Created a button which would output a random number and display on the screen-->
<button type="button" onclick="randomCode()">Generate Invitation Code</button>
<br>
<strong><p id="codeDemo"></p></strong>
<strong><p id="result"></p></strong>

<br>
<br>

<p>A newly created invitation code is valid for 24 hours and has a one time use.</p>
<p>Teacher accounts will be able to create invitation codes and delete user accounts.</p>
<?php include_once 'footer.php'?>