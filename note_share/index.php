<?php include 'header.php'; ?>

<section class="flex-features">
  <?php
  if (!isset($login))
  {
    ?>
    <div>
      <svg width="75mm" height="100mm" viewBox="0 0 210 290">
        <use href="assets/register.svg#1"></use>
      </svg>
      <a class="a-btn" href="signup.php">Register Today!</a>
    </div>
    <?php
  }
  ?>
  <div>
    <svg width="75mm" height="100mm" viewBox="0 0 210 290" >
      <use href="assets/upload.svg#1"></use>
    </svg>
    <a class="a-btn" href="upload.php">Start Uploading!</a>
  </div>
  <div>
    <svg width="75mm" height="100mm" viewBox="0 0 210 290">
      <use href="assets/my-notes.svg#1"></use>
    </svg>
    <a class="a-btn" href="my-notes.php">Manage Your Notes!</a>
  </div>
</section>

<?php include 'browse-notes.php'; ?>

<?php include 'footer.php'; ?>