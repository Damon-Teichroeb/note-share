<?php
include 'dbh.inc.php';

$search = $dbh->real_escape_string($_GET['search']);

if(empty($search))
{
  $object = $dbh->query("SELECT * FROM notes;");
}
else
{
  $object = $dbh->query("SELECT * FROM notes
                         WHERE notes_name REGEXP '$search'
                         OR notes_course_number REGEXP '$search'
                         OR notes_course_name REGEXP '$search'
                         OR notes_teacher REGEXP '$search';");
}
while($note = $object->fetch_row())
  $notes[] = $note;

if(isset($notes))
{
  foreach($notes as $note)
  {
    echo
    "
    <div onclick=\"showNote('".$note[2].$note[3].".pdf');\">
      <h3>".$note[3]."</h3>
      <p>Teacher: <strong>".$note[6]."</strong></p>
      <p>".$note[4].": <strong>".$note[5]."</strong></p>
      <p>By: <strong>".$note[1]."</strong></p>
    </div>
    ";
  }
  unset($notes);
}
else
{
  echo
  "
  <div>
    <h2>There are no notes to display!</h2>
  </div>
  ";
}
?>