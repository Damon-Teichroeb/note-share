<section class="flex-notes">
  <h1>Notes</h1>
  <input style="height: 30px; font-size: 1.2em;" type="text" name="search" onkeyup="showNotes(this.value)" placeholder="Search..">
  <p>Suggestions: <span id="note-hint"></span></p>
  <div class="notes">
    <?php
    $object = $dbh->query("SELECT notes_id, notes_name FROM notes;");
    while($note = $object->fetch_row())
      $notes[] = $note;

    if(isset($notes))
    {
      foreach($notes as $note)
      {
        echo
        "
        <div onclick=\"location.search='?note=".$note[0].$note[1].".pdf'\" style=\"cursor: pointer;\">
          <h3>".$note[1]."</h3>
        </div>
        ";
      }
      unset($notes);
    }
    ?>
  </div>
</section>

<?php
if (isset($_GET['note']))
{
  ?>
  <section class="note-preview">
    <iframe src="notes/<?php echo $_GET['note'];?>" width="80%" height="800"></iframe>
  </section>
  <?php
}
?>