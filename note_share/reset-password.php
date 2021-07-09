<?php
include 'header.php';
?>

<section class="flex-container">
  <h1>Reset Password</h1>
  <form action="includes/reset-password.inc.php" method="post">
    <label for="email">Email:</label>
    <input type="text" class="email" name="email" required><br>
    <input class="a-btn" type="submit" value="Send Validation">
  </form>
  <?php
  if (isset($_GET['reset']))      
    switch ($_GET['reset'])
    {
      case 'success':
        echo "<p class=\"success\">Check your inbox.</p>";
        break;
    }
  ?>
</section>

<?php
include 'browse-notes.php';
?>

<?php
include 'footer.php';
?>