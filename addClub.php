<?php include_once 'header.php'?>

<!-- Now we are in add a club form. Where the users can create a new club. They have to enter the 
club's name, contact information and description. Here as well I have limited their character length to 
the chracter length specified in our database to avoid crashes or confusion. -->

<!-- This is also where I have already added the error handling by using the required keyword. This keyword
restricts the user from going ahead if they haven't entered the previous information. -->

<h2>Add a Club Form</h2>
<section>
    <p><span class="error">* required fields</span></p>
    <form method="post" action="includes/addClubInsert.inc.php">  
      Name of Club: <input type="text" name="clubName" maxlength = "100" required>
      <span class="error">*</span>
      <br><br>
      Contact Information: <input type="text" name="contact" maxlength = "500" required>
      <span class="error">*</span>
      <br><br>
      Description: <textarea name="description" rows="5" cols="40" maxlength = "2000" required></textarea>
      <span class="error">*</span>
      <br><br>
      <input type="submit" name="submit" value="Submit">  
    </form>
</section>

<?php
if (isset($_GET["error"])) {
  switch ($_GET["error"]) {
    case "emptyclubName":
      echo "<p> <font color=red>Please enter the club name.</font></p>";
      break;
    case "emptycontact":
      echo "<p> <font color=red>Please input the contact information.</font> </p>";
      break;
    case "emptydescription":
      echo "<p> <font color=red>Please input the description.</font> </p> ";
      break;
    case "none":
      echo "<p> <font color=green>You've successfully added a club!</font> </p> ";
}
}

?>


<br>
<br>
<br>
<?php include_once 'footer.php'; ?>