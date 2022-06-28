<?php
include 'dbh.inc.php';
include 'note-path.inc.php';

$noteid = $_GET['id'];
$answer = $_POST['answer'];

if ($answer == 'Yes')
{
  $object   = $dbh->query("SELECT notes_name FROM notes WHERE notes_id = '$noteid';");
  $names    = $object->fetch_row();
  $file     = $notepath.$noteid.'-'.$names[0].'.pdf';

  $dbh->query("DELETE FROM notes WHERE notes_id = '$noteid';");
  $dbh->query("DELETE FROM favorites WHERE notes_id = '$noteid';");
  unlink($file);

  header("Location: ../my-notes.php?modify=yes");
}
else if ($answer == 'No')
  header("Location: ../my-notes.php?modify=no");
exit;
?>