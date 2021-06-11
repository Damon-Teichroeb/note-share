<?php
require 'header.php';
?>

<div id="reset">
  <h1>Reset Password</h1>
  <form action="includes/reset-password.inc.php" method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br>
    <input type="submit" value="Send Validation">
  </form>
</div>

<?php
require 'footer.php';
?>