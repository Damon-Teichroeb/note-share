<?php
require 'dbh.inc.php';

session_start();
if (isset($_SESSION['id']))
  $login = $_SESSION['id'];
else
  $login = null;

if (isset($_POST['submit']))
{
  $file     = $_FILES['file'];
  $filetype = $_FILES['file']['type'];
  $name     = $_POST['name'];

  $course   = strtoupper(preg_replace('/\s*\-*\\\*\_*\/*/', '', $_POST['course']));
  if (!preg_match('/^[A-Z]{2}[0-9]{3}$/', $course))
  {
    header("Location: ../upload.php?upload=characters");
  }
  else // success condition
  {
    $filename = $login.$course.$name.$_FILES['file']['name'];
  
    if (preg_match('/^[-0-9A-Z_\.]+$/i', $filename) && $filetype == 'application/pdf')
    {
      $uploadpath = '../notes/'.basename($filename);

      echo '<pre>';
      if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath))
        echo "File is valid, and was successfully uploaded.\n";
      else
        echo "Error, possible file upload attack!\n";

      echo 'Here is some more debugging info:';
      print_r($_FILES);

      print "</pre>";
    }
    else
    {
      echo "File could not upload! The name is too weird!";
    }
  }
}
?>