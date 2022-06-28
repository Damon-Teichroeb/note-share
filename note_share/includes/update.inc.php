<?php
include 'dbh.inc.php';
include 'courses.inc.php';
include 'note-path.inc.php';
session_start();
$login = $_SESSION['id'];

if (isset($_POST['submit']))
{
  // Initalization data recieved from change.inc.php
  $noteid        = $_GET['id'];
  $oldname       = $dbh->real_escape_string($_GET['oldname']);
  isset($_FILES['file']) ? $filetype = $_FILES['file']['type'] : $filetype = null;
  $name          = $dbh->real_escape_string($_POST['name']);
  $coursenumber  = strtoupper(preg_replace('/[^A-Z0-9]*/i', '', $_POST['course']));
  $teacher       = $dbh->real_escape_string($_POST['teacher']);
  $year          = intval($_POST['year']);
  $season        = $dbh->real_escape_string($_POST['season']);

  // Error checking
  if ($filetype != null && $filetype != 'application/pdf')
    header("Location: ../my-notes.php?modify=wrongtype");
  elseif (strlen($name) > 50)
    header("Location: ../my-notes.php?modify=over50");
  elseif (!preg_match('/^[-0-9A-Z_\.\s]+$/i', $name))
    header("Location: ../my-notes.php?modify=invalidname");
  elseif (!empty($dbh->query("SELECT notes_name FROM notes WHERE users_id = '$login' AND notes_name = '$name';")->fetch_row()) && $name != $oldname)
    header("Location: ../my-notes.php?modify=nameexists");
  elseif (!preg_match('/^[A-Z]{2}[0-9]{3}$/', $coursenumber))
    header("Location: ../my-notes.php?modify=not5");
  elseif (!empty($teacher) && !preg_match('/^[-0-9A-Z_\.\s]+$/i', $teacher))
    header("Location: ../my-notes.php?modify=invalidteacher");
  else // Success condition
  {
    // Puts a dash in the $coursenumber and creates a $coursename using the $courseletters
    $coursenumber  = substr_replace($coursenumber, "-", 2, 0);
    $courseletters = substr($coursenumber, 0, 2);
    $coursename    = isset($courses[$courseletters]) ? $courses[$courseletters] : 'Unknown';

    // Updates any changes made from the user
    $dbh->query("UPDATE notes
                 SET notes_name          = '$name',
                     notes_course_number = '$coursenumber',
                     notes_course_name   = '$coursename',
                     notes_teacher       = '$teacher',
                     notes_year          = '$year',
                     notes_season        = '$season'
                 WHERE notes_id = '$noteid';");

    // Overwrites the pdf file on the server
    $oldpath    = $notepath.$noteid.'-'.$oldname.'.pdf';
    $uploadpath = $notepath.$noteid.'-'.$name.'.pdf';
    if($filetype != null)
    {
      unlink($oldpath);
      move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath);
    }
    else
      rename($oldpath, $uploadpath);
    
    header("Location: ../my-notes.php?modify=success");
  }
}
exit;
?>