<?php
require 'header.php';
?>

<section class="flex-container">
  <?php
  if (!isset($login))
  {
  ?>
  <h1>Login</h1>
  <form action="includes/login.inc.php" method="post">
    <label for="email">Email:</label>
    <input class="text-box" type="email" id="email" name="email" required
      value="<?php if(isset($_GET['email'])){echo $_GET['email'];}elseif(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"><br>
    <label for="password">Password:</label>
    <input class="text-box" type="password" id="password" name="password" required
      value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>"><br>
    <label for="remember">Remember Login:</label>
    <input type="checkbox" id="remember" name="remember" <?php if(isset($_GET['remember'])){echo 'checked';}?>>
    <input class="btn" type="submit" value="Login">
  </form>
  <p>Don't have an account?:<a class="btn" href="signup.php">Register</a></p>
  <p>Forgot password?:<a class="btn" href="reset-password.php">Reset Password</a></p>
  <?php
  // Login notifications
  if (isset($_GET['login']))
    switch ($_GET['login'])
    {
      case 'wrongpassword':
        echo "<p class=\"error\">Incorrect password or email!</p>";
        break;
    }
  }
  ?>
</section>

<?php
require 'footer.php';
?>