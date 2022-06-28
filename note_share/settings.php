<?php include 'header.php'; ?>

<section class="flex-container">
  <h1>Settings</h1>
  <div class="flex-settings">
    <a class="settings-btn" href="javascript:settings('name')">Change Name</a>
    <a class="settings-btn" href="javascript:settings('pass')">Change Password</a>
    <a class="settings-btn" href="javascript:settings('close')">Close Account</a>
  </div>
  <form id="settings" action="includes/settings.inc.php" method="post"></form>
  <?php
  // Settings notifications
  if (isset($_GET['settings']))
    switch ($_GET['settings'])
    {
      case 'invalidname':
        echo "<p class=\"error\">The name you used is invalid. Please avoid using special characters: !@#$%^&*()+=;':\"[]{}|\\/<></p>";
        break;
      case 'name':
        echo "<p class=\"success\">You have successfully changed your name!</p>";
        break;
      case 'wrongpassword':
        echo "<p class=\"error\">The Current Password is incorrect!</p>";
        break;
      case 'mismatch':
        echo "<p class=\"error\">The new passwords do not match!</p>";
        break;
      case 'pass':
        echo "<p class=\"success\">Your new password was successfully set!</p>";
    }
  ?>
</section>

<?php include 'browse-notes.php'; ?>

<?php include 'footer.php'; ?>