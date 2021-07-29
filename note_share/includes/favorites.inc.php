<?php
include 'dbh.inc.php';
session_start();
$login   = $_SESSION['id'];
$mode    = $_GET['mode'];
$noteid  = $_GET['id'];
$search  = $_GET['search'];

if (empty($dbh->query("SELECT users_id FROM favorites WHERE users_id = '$login' AND notes_id = '$noteid';")->fetch_row()))
{
  if ($mode == 'Like')
  {
    $dbh->query("INSERT INTO favorites(users_id, notes_id, favorites_liked, favorites_disliked)
                 VALUES ('$login', '$noteid', 1, 0);");
  }
  elseif ($mode == 'Dislike')
  {
    $dbh->query("INSERT INTO favorites(users_id, notes_id, favorites_liked, favorites_disliked)
                 VALUES ('$login', '$noteid', 0, 1);");
  }
}
else
{
  if ($mode == 'Like')
  {
    $dbh->query("UPDATE favorites SET favorites_liked = 1, favorites_disliked = 0
                 WHERE users_id = '$login' AND notes_id = '$noteid';");
  }
  elseif ($mode == 'Dislike')
  {
    $dbh->query("UPDATE favorites SET favorites_liked = 0, favorites_disliked = 1
                 WHERE users_id = '$login' AND notes_id = '$noteid';");
  }
  else
    $dbh->query("DELETE FROM favorites WHERE users_id = '$login' AND notes_id = '$noteid';");
}
$dbh->query("
UPDATE notes
SET notes_likes = (SELECT COUNT(*) FROM favorites WHERE notes_id = '$noteid' AND favorites_liked = 1),
    notes_dislikes = (SELECT COUNT(*) FROM favorites WHERE notes_id = '$noteid' AND favorites_disliked = 1)
WHERE notes_id = '$noteid';");
?>