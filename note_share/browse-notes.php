<section class="flex-notes">
  <h1>Notes</h1>
  <input class="text-box" type="text" name="search" onkeyup="listNotes(this.value)" placeholder="Search..">
  <div class="notes" id="notes">
  </div>
</section>

<?php
print_r($_SERVER['REMOTE_ADDR']);
?>

<section class="flex-preview-notes" id="preview-notes">
</section>