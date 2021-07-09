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
    <div onclick=\"showNote('".$note[1].$note[2].".pdf');\" style=\"cursor: pointer;\">
      <h3>".$note[2]."</h3>
    </div>
    ";
  }
  unset($notes);
}
?>