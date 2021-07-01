<?php
require 'header.php';
?>

<section class="features">
  <?php
  if (!isset($login))
  {
  ?>
    <div>
      <p>Don't have an account with us yet? signing up is easy!</p>
      <a class="btn" href="signup.php">Register</a>
    </div>
  <?php
  }
  ?>
  <div>
    <p>Upload your notes for your peers to see!</p>
    <a class="btn" href="upload.php">Upload</a>
  </div>
</section>

<?php
require 'footer.php';
?>