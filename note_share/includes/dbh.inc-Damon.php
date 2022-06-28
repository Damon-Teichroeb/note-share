<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "note_share";

// Create connection
$dbh = new mysqli($servername, $username, $password, $database);

// Check connection
if ($dbh->connect_error)
  die("Connection failed: " . $dbh->connect_error);
?>