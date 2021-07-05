<section class="flex-notes">
  <h1>Notes</h1>
  <div class="notes">
    <?php
    $object = $dbh->query("SELECT notes_id, notes_name FROM notes;");
    while($note = $object->fetch_row())
      $notes[] = $note;

    if(isset($notes))
      foreach($notes as $note)
      {
        echo  "<div>
                <h3>".$note[1]."</h3>
                <img src=\"notes/".$note[0].$note[1].".pdf\">
              </div>";
      }
    unset($notes);
    ?>
  </div>
</section>