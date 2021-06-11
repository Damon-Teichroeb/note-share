<?php
require 'header.php';
?>

<?php
if (!isset($login))
{
?>
  <div id="login">
    <h1>Login</h1>
    <form action="includes/login.inc.php" method="post">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required
        value="<?php if(isset($_GET['email'])){echo $_GET['email'];}elseif(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"
      ><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required
        value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>"
      ><br>
      <label for="remember">Remember Login:</label>
      <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE['password'])){echo 'checked';}?>
      ><br>
      <input type="submit" value="Login">
    </form><br>
    <label>Don't have an account?:</label>
    <a href="signup.php">Register</a><br>
    <label>Forgot password?:</label>
    <a href="reset-password.php">Reset Password</a>
  <?php
  // Login error message
  if (isset($_GET['login']))
      switch ($_GET['login'])
      {
        case 'wrongpassword':
          echo "<p id=\"error\">Incorrect password or email!</p>";
          break;
      }
  // Signup notification
  if (isset($_GET['signup']))
      switch ($_GET['signup'])
      {
        case 'success':
          echo "<p id=\"success\">You have successfuly registered an account!</p>";
          break;
      }
  ?>
  </div>
<?php
}
?>

<div id="notes">
  <h1>Featured Notes</h1>
  <embed src="notes/test.pdf#toolbar=0" type="application/pdf" width="60%" height="600px">
</div>

<?php
require 'footer.php';
?>