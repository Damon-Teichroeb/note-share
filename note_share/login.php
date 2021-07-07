<?php
include 'header.php';
?>

<section class="flex-container">
  <?php
  if (!isset($login))
  {
    ?>
    <h1>Login</h1>
    <form action="includes/login.inc.php<?php echo(isset($_GET['upload'])&&$_GET['upload']=='login')?'?upload=login':'';?>" method="post">
      <label for="email">Email:</label>
      <input class="text-box" type="email" id="email" name="email" included
        value="<?php if(isset($_GET['email'])){echo $_GET['email'];}elseif(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"><br>
      <label for="password">Password:</label>
      <input class="text-box" type="password" id="password" name="password" included
        value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>"><br>
      <label for="remember">Remember Login:</label>
      <input type="checkbox" id="remember" name="remember" <?php if(isset($_GET['remember'])){echo 'checked';}?>>
      <input class="a-btn" type="submit" value="Login">
    </form>
    <p>Don't have an account?: <a class="a-btn" href="signup.php">Register</a></p>
    <p>Forgot password?: <a class="a-btn" href="reset-password.php">Reset Password</a></p>
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
include 'footer.php';
?>