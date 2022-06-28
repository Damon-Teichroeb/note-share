<?php include 'header.php'; ?>

<section class="flex-container">
  <h1>Sign Up</h1>
  <form action="includes/signup.inc.php" method="post">
    <input class="text-box" type="email" id="email" name="email" placeholder="E-mail" required
      value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
    ><br>
    <input class="text-box" type="text" id="name" name="name" placeholder="Name" required
      value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>"
    ><br>
    <input class="text-box" type="password" id="password" name="password" placeholder="Password" required><br>
    <input class="text-box" type="password" id="repassword" name="repassword" placeholder="Re-enter Password" required><br>
    <input class="a-btn" type="submit" value="Register">
  </form>
  <?php
  // Signup notifications
  if (isset($_GET['signup']))      
    switch ($_GET['signup'])
    {
      case 'invalidemail':
        echo "<p class=\"error\">Please use a valid email.</p>";
        break;
      case 'invalidname':
        echo "<p class=\"error\">The name you used is invalid. Please avoid using special characters: !@#$%^&*()+=;':\"[]{}|\\/<></p>";
        break;
      case 'passwordmismatch':
        echo "<p class=\"error\">Passwords do not match.</p>";
        break;
      case 'duplicateemail':
        echo "<p class=\"error\">That email already exists on this website.</p>";
    }
  ?>
</section>

<?php include 'browse-notes.php'; ?>

<?php include 'footer.php'; ?>