<?php include_once 'header.php'?>

<h2>Add a Club Form</h2>
<section>
    <p><span class="error">* required fields</span></p>
    <form method="post" action="addClubInsert.php">  
      Name of Club: <input type="text" name="clubName" required>
      <span class="error">*</span>
      <br><br>
      Contact Information: <input type="text" name="contact" required>
      <span class="error">*</span>
      <br><br>
      Description: <textarea name="description" rows="5" cols="40" required></textarea>
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