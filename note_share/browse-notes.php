<section class="flex-notes">
  <h1>Notes</h1>
  <input class="text-box" type="text" name="search" placeholder="Search.." 
    onkeyup="listNotes(this.value, '<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>')" />
  <div class="notes" id="notes"></div>
</section>

<section class="flex-preview-notes" id="preview-notes"></section>