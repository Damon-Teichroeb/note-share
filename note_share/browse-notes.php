<section class="flex-notes">
  <h1>Notes</h1>
  <div style="margin: 10px auto">
  <input id="search" class="text-box" type="text" name="search" placeholder="Search.." 
      onkeyup="listNotes('<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>', this.value, '', '');" />
    <p>Sort By:</p>
    <button class="sort-btn-on" id="sort-recent" value="1"
      onclick="sortNotes(this.value, document.getElementById('search').value, '<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>');">Most Recent Notes</button>
    <button class="sort-btn" id="sort-old"       value="2"
      onclick="sortNotes(this.value, document.getElementById('search').value, '<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>');">Oldest Notes</button>
    <button class="sort-btn" id="sort-likes"     value="3"
      onclick="sortNotes(this.value, document.getElementById('search').value, '<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>');">Most Liked Notes</button>
    <button class="sort-btn" id="sort-dislikes"  value="4"
      onclick="sortNotes(this.value, document.getElementById('search').value, '<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>');">Most Disliked Notes</button>
    <button class="sort-btn" id="sort-rated"     value="5"
      onclick="sortNotes(this.value, document.getElementById('search').value, '<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>');">Highest Rated Notes</button>
  </div>
  <div class="notes" id="notes"></div>
</section>

<section class="flex-preview-notes" id="preview-notes"></section>