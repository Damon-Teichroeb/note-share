<?php
require 'dbh.inc.php';

session_start();
if (isset($_SESSION['id']))
  $login = $_SESSION['id'];
else
  $login = null;

if (isset($_POST['submit']))
{
  $filetype = $_FILES['file']['type'];
  $name     = $dbh->real_escape_string($_POST['name']);
  $course   = strtoupper(preg_replace('/[^A-Z0-9]*/i', '', $_POST['course']));
  $teacher  = $dbh->real_escape_string($_POST['teacher']);
  $year     = intval($_POST['year']);
  $season   = intval($_POST['season']);

  // Error checking
  if ($filetype != 'application/pdf')
    header("Location: ../upload.php?upload=wrongtype");
  elseif (!preg_match('/^[-0-9A-Z_\.\s]+$/i', $name))
    header("Location: ../upload.php?upload=invalidname");
  elseif (!empty($dbh->query("SELECT notes_name FROM notes WHERE users_id = '$login' AND notes_name = '$name';")->fetch_row()))
    header("Location: ../upload.php?upload=nameexists"); // Checks if the current name and login are already in the database
  elseif (!preg_match('/^[A-Z]{2}[0-9]{3}$/', $course))
    header("Location: ../upload.php?upload=not5");
  elseif (!empty($teacher) && !preg_match('/^[-0-9A-Z_\.\s]+$/i', $teacher))
    header("Location: ../upload.php?upload=invalidteacher");
  else // Success condition
  {
    $dbh->query("INSERT INTO notes (users_id, notes_name, notes_course, notes_teacher, notes_year, notes_season)
                 VALUES ('$login', '$name', '$course', '$teacher', '$year', '$season');");
    $object    = $dbh->query("SELECT notes_id FROM notes WHERE users_id = '$login' AND notes_name = '$name';");
    $ids       = $object->fetch_row();
    $filename  = $ids[0].$name.'.pdf';

    $uploadpath = '../notes/'.$filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath);

    header("Location: ../upload.php?upload=success");
  }
}
?>