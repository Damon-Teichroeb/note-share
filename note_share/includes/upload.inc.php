<?php
require 'dbh.inc.php';
include 'courses.inc.php';

session_start();
if (isset($_SESSION['id']))
  $login = $_SESSION['id'];
else
  $login = null;

if (isset($_POST['submit']))
{
  // Initalization data recieved from upload.php
  $filetype      = $_FILES['file']['type'];
  $name          = $dbh->real_escape_string($_POST['name']);
  $coursenumber  = strtoupper(preg_replace('/[^A-Z0-9]*/i', '', $_POST['course']));
  $teacher       = $dbh->real_escape_string($_POST['teacher']);
  $year          = intval($_POST['year']);
  $season        = intval($_POST['season']);

  // Error checking
  if ($filetype != 'application/pdf')
    header("Location: ../upload.php?upload=wrongtype");
  elseif (!preg_match('/^[-0-9A-Z_\.\s]+$/i', $name))
    header("Location: ../upload.php?upload=invalidname"); // Checks if the current name and login are already in the database
  elseif (!empty($dbh->query("SELECT notes_name FROM notes WHERE users_id = '$login' AND notes_name = '$name';")->fetch_row()))
    header("Location: ../upload.php?upload=nameexists");
  elseif (!preg_match('/^[A-Z]{2}[0-9]{3}$/', $coursenumber))
    header("Location: ../upload.php?upload=not5");
  elseif (!empty($teacher) && !preg_match('/^[-0-9A-Z_\.\s]+$/i', $teacher))
    header("Location: ../upload.php?upload=invalidteacher");
  else // Success condition
  {
    // Gets the name of the currently logged in user
    $object    = $dbh->query("SELECT users_name FROM users WHERE users_id = '$login';");
    $names     = $object->fetch_row();
    $loginname = $names[0];

    // Puts a dash in the $coursenumber and creates a $coursename using the $courseletters
    $coursenumber  = substr_replace($coursenumber, "-", 2, 0);
    $courseletters = substr($coursenumber, 0, 2);
    $coursename    = isset($courses[$courseletters]) ? $courses[$courseletters] : 'Unknown' ;

    // Inserts all of the information about the file into the database
    $dbh->query("INSERT INTO notes (users_id, users_name, notes_name, notes_course_number, notes_course_name, notes_teacher, notes_year, notes_season)
                 VALUES ('$login', '$loginname', '$name', '$coursenumber', '$coursename', '$teacher', '$year', '$season');");

    // Creates the pdf file on the computer
    $object     = $dbh->query("SELECT notes_id FROM notes WHERE users_id = '$login' AND notes_name = '$name';");
    $ids        = $object->fetch_row();
    $filename   = $ids[0].$name.'.pdf';
    $uploadpath = '../notes/'.$filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath);

    header("Location: ../upload.php?upload=success&name=".$name."&course=".$coursenumber."&teacher=".$teacher."&year=".$year."&season=".$season."");
  }
}
?>