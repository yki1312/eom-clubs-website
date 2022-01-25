<?php include_once 'header.php'?>

<!-- addClub.php is where the users can create a new club. They have to enter the 
club's name, contact information and description. There is a limit to the number of character length to 
avoid crashes or confusion. -->

<!-- This is also where I have added the error handling by using the required keyword. This keyword
restricts the user from going ahead if they haven't entered the previous information. -->
<div class="container">
  <h2>Add a Club Form</h2>
  <section>
      <p><span class="error">** required fields</span></p>
      <form method="post" action="includes/addClubInsert.inc.php">
        <div><label class="form-label">Name of Club **</label></div>  
        <div class="col-5"><input type="text" class="form-control" name="clubName" maxlength = "100" required></div>
        <br><br>
        <div><label class="form-label">Contact Information **</label></div>
        <div class="col-5"><textarea name="contact" class="form-control" rows="5" cols="40" maxlength = "500" required></textarea></div>
        <br><br>
        <div><label class="form-label">Description **</label></div>
        <div class="col-5"><textarea name="description" class="form-control" rows="5" cols="40" maxlength = "2000" required></textarea></div>
        <br>
        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        <br>  
      </form>
  </section>
</div>

<?php
if (isset($_GET["error"])) {
  switch ($_GET["error"]) {
    case "none":
      echo "<br><p class='container'><font color=green>You've successfully added a club!</font> </p> ";
      break;
    case "clubExist":
      echo "<br><p class='container'><font color=red>This club already exists. Please try a different name!</font> </p> ";
      break;
  }
}

?>

<br>
<br>
<br>
<?php include_once 'footer.php'; ?>