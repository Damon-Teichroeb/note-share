<?php
include 'dbh.inc.php';

$noteid   = $_GET['id'];
$object   = $dbh->query("SELECT * FROM notes WHERE notes_id = '$noteid';");
$notedata = $object->fetch_row();
?>

<h1>Change Notes</h1>
<form id="change-form" action="includes/update.inc.php<?php echo '?id='.$noteid.'&oldname='.$notedata[3];?>" method="post" enctype="multipart/form-data">
  <p>It's preferable that you upload one <strong>pdf</strong> file containing the entire class of notes for a semester.</p>
  <label for="file">Please select a <strong>pdf</strong> file from your device (Optional):</label>
  <input class="a-btn" id="file" type="file" name="file" accept="application/pdf"><br><br>
  <label for="name">File Name:</label>
  <input class="text-box" type="text" id="name" name="name" required value="<?php echo $notedata[3];?>"><br>
  <label for="course">Course Number:</label>
  <input class="text-box" type="text" id="course" name="course" required value="<?php echo $notedata[4];?>"><br>
  <label for="teacher">(Optional) Teacher:</label>
  <input class="text-box" type="text" id="teacher" name="teacher" value="<?php echo $notedata[6];?>"><br>
  <label for="year">Year:</label>
  <input class="text-box" type="number" id="year" name="year" min="1900" max="2200" step="1" required value="<?php echo $notedata[7];?>"><br>
  <label for="spring">Spring:</label>
  <input type="radio" id="spring" value="Spring" name="season" checked>
  <label for="fall">Fall:</label>
  <input type="radio" id="fall" value="Fall" name="season" <?php if($notedata[8] == "Fall"){echo 'checked';}?>><br>
  <input class="a-btn" type="submit" name="submit" value="Change">
</form>