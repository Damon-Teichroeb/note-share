<?php
include 'dbh.inc.php';
session_start();

$likes = '';
$dislikes = '';
if (isset($_SESSION['id'])) 
{
  $login = $_SESSION['id'];

  $object = $dbh->query("SELECT notes_id FROM favorites WHERE users_id = '$login' AND favorites_liked = 1;");
  while($like = $object->fetch_row())
    $likes .= $like[0].'-';

  $object = $dbh->query("SELECT notes_id FROM favorites WHERE users_id = '$login' AND favorites_disliked = 1;");
  while($dislike = $object->fetch_row())
    $dislikes .= $dislike[0].'-';
}
else $login = null;
  
$search = $dbh->real_escape_string($_GET['search']);
$page   = $_GET['page'];

if (isset($_GET['sort']))
  switch ($_GET['sort'])
  {
    case 2:
      $sort = "ORDER BY notes_id ASC LIMIT 50";
      break;
    case 3:
      $sort = "ORDER BY notes_likes DESC, notes_id DESC LIMIT 50";
      break;
    case 4:
      $sort = "ORDER BY notes_dislikes DESC, notes_id DESC LIMIT 50";
      break;
    case 5:
      $sort = "ORDER BY notes_rating DESC, notes_id DESC LIMIT 50";
      break;
    default:
      $sort = "ORDER BY notes_id DESC LIMIT 50";
  }
else $sort = "ORDER BY notes_id DESC LIMIT 50";

if ($page == 'mynotes')
  if (empty($search)) $sql = "SELECT * FROM notes WHERE users_id = '$login' $sort;";
  else                $sql = "SELECT * FROM notes
                              WHERE users_id = '$login'
                              AND (notes_name REGEXP '$search'
                              OR notes_course_number REGEXP '$search'
                              OR notes_course_name REGEXP '$search'
                              OR notes_teacher REGEXP '$search'
                              OR users_name REGEXP '$search'
                              OR notes_year REGEXP '$search'
                              OR notes_season REGEXP '$search')
                              $sort;";
else
  if (empty($search)) $sql = "SELECT * FROM notes $sort;";
  else                $sql = "SELECT * FROM notes
                              WHERE notes_name REGEXP '$search'
                              OR notes_course_number REGEXP '$search'
                              OR notes_course_name REGEXP '$search'
                              OR notes_teacher REGEXP '$search'
                              OR users_name REGEXP '$search'
                              OR notes_year REGEXP '$search'
                              OR notes_season REGEXP '$search'
                              $sort;";

$object = $dbh->query($sql);
while ($note = $object->fetch_row()) $notes[] = $note;
if (isset($notes))
{
  foreach ($notes as $note)
  {
    echo "
    <div id=\"note".$note[2]."\">
      <div onclick=\"showNote('".$note[2]."-".$note[3].".pdf', '$page', '$login', '$likes', '$dislikes', '$search')\">
        <h3>".$note[3]."</h3>
        <p><strong>".$note[4]."</strong>: <strong>".$note[5]."</strong></p>
        ".(empty($note[6]) ? '<p>No specified teacher</p>' : '<p>Teacher: <strong>'.$note[6].'</strong></p>')."
        <p>Year: <strong>".$note[7]."</strong>, <strong>".$note[8]."</strong></p>
        <p>By: <strong>".$note[1]."</strong></p>
        <p>".$note[9]." : ".$note[10]."</p>
      </div>
      <div id=\"option".$note[2]."\"></div>
    </div>";
  }
  unset($notes);
}
else echo "<h2>There are no notes to display!</h2>";
exit;
?>