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
  $course   = strtoupper(preg_replace('/[^A-Z0-9]*/i', '', $_POST['course']));
  $year     = intval($_POST['year']);
  $season   = intval($_POST['season']);

  if (!preg_match('/^[A-Z]{2}[0-9]{3}$/', $course))
  {
    header("Location: ../upload.php?upload=not5");
  }
  else // success condition
  {
    $dbh->query("INSERT INTO notes (users_id, notes_name, notes_course, notes_year, notes_season)
                 VALUES ('$login', '$name', '$course', '$year', '$season');");

    $object   = $dbh->query("SELECT notes_id FROM notes
                             WHERE users_id = '$login'
                             AND notes_name = '$name';");
    $ids      = $object->fetch_row();
    $filename = $ids[0].'.pdf';
  
    if (preg_match('/^[-0-9A-Z_\.]+$/i', $filename) && $filetype == 'application/pdf')
    {
      $uploadpath = '../notes/'.basename($filename);
      move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath);

      header("Location: ../upload.php?upload=success");
    }
    else
    {
      echo "File could not upload! The name is too weird!";
    }
  }
}
?>