<?php
include 'dbh.inc.php';
include 'note-path.inc.php';
session_start();
$login = $_SESSION['id'];

switch ($_POST['submit'])
{
  case 'Change Name':
    $newname = $dbh->real_escape_string($_POST['name']);
    if (!preg_match('/^[-0-9A-Z_\.\s]+$/i', $newname))
      header("Location: ../settings.php?settings=invalidname");
    else
    {
      $dbh->query("UPDATE users SET users_name = '$newname' WHERE users_id = '$login';");
      header("Location: ../settings.php?settings=name");
    }
    break;
  case 'Change Password':
    $currentpass = $dbh->real_escape_string($_POST['cpass']);
    $newpass     = $dbh->real_escape_string($_POST['npass']);
    $repass      = $dbh->real_escape_string($_POST['rpass']);

    $object = $dbh->query("SELECT users_password FROM users WHERE users_id = '$login';");
    $hash   = $object->fetch_assoc();

    // Error checking
    if (!password_verify($currentpass, $hash['users_password']))
      header("Location: ../settings.php?settings=wrongpassword");
    elseif ($newpass != $repass)
      header("Location: ../settings.php?settings=mismatch");
    else // Success condition
    {
      $newhash = password_hash($newpass, PASSWORD_DEFAULT);
      $dbh->query("UPDATE users SET users_password = '$newhash' WHERE users_id = '$login';");
      header("Location: ../settings.php?settings=pass");
    }
    break;
  case 'Yes':
    // Deletes the notes on the server
    $object = $dbh->query("SELECT notes_id, notes_name FROM notes WHERE users_id = '$login';");
    while ($note = $object->fetch_row()) $notes[] = $note;
    if (isset($notes))
    {
      foreach ($notes as $note)
        unlink($notepath.$note[0].'-'.$note[1].'.pdf');
      unset($notes);
    }

    // Counts the likes and dislikes and sets them to each note
    $object = $dbh->query("SELECT notes_id FROM favorites WHERE users_id = '$login';");
    $dbh->query("DELETE FROM favorites WHERE users_id = '$login';");
    while ($note = $object->fetch_row()) $notes[] = $note;
    if (isset($notes))
      foreach ($notes as $note)
      {
        $noteid = $note[0];

        $dbh->query("UPDATE notes
        SET notes_likes = (SELECT COUNT(*) FROM favorites WHERE notes_id = '$noteid' AND favorites_liked = 1),
            notes_dislikes = (SELECT COUNT(*) FROM favorites WHERE notes_id = '$noteid' AND favorites_disliked = 1)
        WHERE notes_id = '$noteid';");
        $object = $dbh->query("SELECT notes_likes, notes_dislikes FROM notes WHERE notes_id = '$noteid';");
        $row    = $object->fetch_row();
        if     ($row[0] == 0)                 $rating = 0;
        elseif ($row[0] == 1 && $row[1] == 0) $rating = 1;
        else                                  $rating = floatval($row[0]) / floatval($row[1]);
        $dbh->query("UPDATE notes SET notes_rating = $rating WHERE notes_id = '$noteid';");
      }

    // Deletes the remaining information
    $dbh->query("DELETE FROM users WHERE users_id = '$login';");
    $dbh->query("DELETE FROM notes WHERE users_id = '$login';");
    unset($_SESSION['id']);
    session_destroy();
    header("Location: ../index.php?login=logout");
    break;
  case 'No':
    header("Location: ../settings.php");
}
?>