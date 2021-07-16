<?php
include 'header.php';
?>

<section class="flex-container">
  <?php
  if (isset($login))
  {
    ?>
    <h1>My Notes</h1>
    <?php
  }
  else
  {
    ?>
    <p>You must be logged in to see your notes: <a class="a-btn" href="login.php?page=mynotes">Login</a></p>
    <?php
  }
  ?>
</section>

<?php
include 'footer.php';
?>