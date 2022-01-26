<?php
// deletes all $_SESSION variables
session_start();
session_unset();
session_destroy();
header("location: ../main_page.php");
exit();
