<?php
include 'header.php';
?>

<section class="flex-features">
  <?php
  if (!isset($login))
  {
    ?>
    <div>
      <p>Don't have an account yet? signing up is easy!</p>
      <img src="assets/3.jpg" width="100%" height="400px">
      <a class="a-btn" href="signup.php">Register Today!</a>
    </div>
    <?php
  }
  ?>
  <div>
    <p>Upload your notes for your peers to see!</p>
    <img src="assets/7.jpg" width="100%" height="400px">
    <a class="a-btn" href="upload.php">Start Uploading!</a>
  </div>
  <div>
    <p>See all of the notes that you've uploaded!</p>
    <img src="assets/2.jpg" width="100%" height="400px">
    <a class="a-btn" href="my-notes.php">Go to My Notes!</a>
  </div>
</section>

<?php
include 'browse-notes.php';
?>

<?php
include 'footer.php';
?>