<?php
include 'header.php';
?>

<section class="flex-container">
  <h1>Reset Password</h1>
  <form action="includes/reset-password.inc.php" method="post">
    <input class="text-box" type="text" class="email" name="email" placeholder="E-mail" required><br>
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