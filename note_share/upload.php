<?php
include 'header.php';
?>

<section class="flex-container">
  <?php
  if (isset($login))
  {
    ?>
    <h1>Upload Notes</h1>
    <form id="upload-form" action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
      <label for="file">Please select a <strong>pdf</strong> file from your device:</label><br>
      <input id="file" type="file" name="file" accept="application/pdf" required><br>
      <label for="name">File Name:</label>
      <input class="text-box" type="text" id="name" name="name" required
        value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>"><br>
      <label for="course">Course Number:</label>
      <input class="text-box" type="text" id="course" name="course" placeholder="Example: CS-442" required
        value="<?php if(isset($_GET['course'])){echo $_GET['course'];}?>"><br>
      <label for="teacher">(Optional) Teacher:</label>
      <input class="text-box" type="text" id="teacher" name="teacher" placeholder="Example: Dr. Hildendorf"
        value="<?php if(isset($_GET['teacher'])){echo $_GET['teacher'];}?>"><br>
      <label for="year">Year:</label>
      <input class="text-box" type="number" id="year" name="year" min="1900" max="2200" step="1" required
        value="<?php if(isset($_GET['year'])){echo $_GET['year'];}else{echo '2021';}?>"><br>
      <label for="fall">Fall:</label>
      <input type="radio" id="fall" value=0 name="season" checked>
      <label for="spring">Spring:</label>
      <input type="radio" id="spring" value=1 name="season" <?php if(isset($_GET['season'])&&$_GET['season'] == 1){echo 'checked';}?>><br>
      <input class="a-btn" type="submit" name="submit" value="Upload">
    </form>
    <label for="upload-bar">Uploading progress:</label>
    <progress id="upload-bar" value="0" max="100"></progress>
    <?php
    // Upload notifications
    if (isset($_GET['upload']))
      switch ($_GET['upload'])
      {
        case 'wrongtype':
          echo "<p class=\"error\">Please ensure that the file is a <strong>pdf</strong> file.</p>";
          break;
        case 'nameexists':
          echo "<p class=\"error\">You already have a note with that name.</p>";
          break;
        case 'invalidname':
          echo "<p class=\"error\">The name you used is invalid. Please avoid using special characters: !@#$%^&*()+=;':\"[]{}|\\/<></p>";
          break;
        case 'not5':
          echo "<p class=\"error\">Please ensure that the Course Number is exactly 5 characters long.</p>";
          break;
        case 'invalidteacher':
          echo "<p class=\"error\">The teacher name you used is invalid. Please use another teacher name.</p>";
          break;
        case 'success':
          echo "<p class=\"success\">Your file upload was successful!</p>";
      }
  }
  else
  {
    ?>
    <p>You must be logged in to upload notes: <a class="a-btn" href="login.php?page=upload">Login</a></p>
    <?php
  }
  ?>
</section>

<?php
include 'browse-notes.php';
?>

<?php
include 'footer.php';
?>