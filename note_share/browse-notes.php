<section class="flex-notes" style="background: rgb(1, 146, 165);">
  <h1>Notes</h1>
    <div class="notes">
    <?php
    $object = $dbh->query("SELECT notes_id, notes_name FROM notes;");
    while($note = $object->fetch_row())
      $notes[] = $note;

    if(isset($notes))
      foreach($notes as $note)
      {
        echo "<div>
                <h3>".$note[1]."</h3>
              </div>";
      }
    unset($notes);
    ?>
    </div>
</section>