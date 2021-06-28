<?php
require 'header.php';
?>

<section class="flex-container">
  <?php
  if (isset($login))
  {
  ?>
    <h1>Upload Notes</h1>
    <form action="includes/upload.inc.php" method="post">
      <label for="file">Please select a <strong>pdf</strong> file from your device:</label><br>
      <input class="btn" id="file" type="file" name="file" accept="application/pdf" required><br>
      <label for="fall">Fall:</label>
      <input type="radio" id="fall" value=1 name="season" checked>
      <label for="spring">Spring:</label>
      <input type="radio" id="spring" value=2 name="season"><br>
      <label for="year">Year:</label>
      <input class="text-box" type="number" id="year" name="year" min="1900" max="2200" step="1" value="2021" required><br>
      <label for="course">Course Number:</label>
      <input class="text-box" type="text" id="course" name="course" placeholder="Example: CS442" required><br>
      <input class="btn" type="submit" value="Upload">
    </form>
  <?php
  }
  else
  {
  ?>
    <p>You must be logged in to upload files:<a class="btn" href="login.php">Login</a></p>
  <?php
  }
  ?>
</section>

<?php
require 'footer.php';
?>