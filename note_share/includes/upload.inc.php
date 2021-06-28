<?php
require 'dbh.inc.php';
include 'courses.inc.php';

$pdf    = $_POST['file'];
$season = $_POST['season'];
$year   = $_POST['year'];
$course = $_POST['course'];

echo "<p>$pdf</p>
      <iframe src=\"$pdf\"></iframe>
      <p>$season</p>
      <p>$year</p>
      <p>$course</p>";
?>