<?php
// creates a connection to database
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "TestDB";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
