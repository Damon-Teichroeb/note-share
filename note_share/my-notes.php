<?php
include 'header.php';
?>

<section class="flex-container" id="modify-notes">
  <?php
  // Update notifications
  if (isset($_GET['modify']))
    switch ($_GET['modify'])
    {
      case 'wrongtype':
        echo "<p class=\"error\">Please ensure that the file is a <strong>pdf</strong> file.</p>";
        break;
      case 'over50':
        echo "<p class=\"error\">That name is over 50 characters long.</p>";
        break;
      case 'invalidname':
        echo "<p class=\"error\">The name you used is invalid. Please avoid using special characters: !@#$%^&*()+=;':\"[]{}|\\/<></p>";
        break;
      case 'nameexists':
        echo "<p class=\"error\">You already have a note with that name.</p>";
        break;
      case 'not5':
        echo "<p class=\"error\">Please ensure that the Course Number is exactly 5 characters long.</p>";
        break;
      case 'invalidteacher':
        echo "<p class=\"error\">The teacher name you used is invalid. Please use another teacher name.</p>";
        break;
      case 'success':
        echo "<p class=\"success\">Your note change was successful!</p>";
        break;
      case 'yes':
        echo "<p class=\"success\">Your note was deleted!</p>";
    }
  ?>
</section>

<?php
if (isset($login))
  include 'browse-notes.php';
else
{
  ?>
  <section class="flex-container">
    <p>You must be logged in to see your notes: <a class="a-btn" href="login.php?page=mynotes">Login</a></p>
  </section>
  <?php
}
?>

<?php
include 'footer.php';
?>