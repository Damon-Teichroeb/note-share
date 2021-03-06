<?php include 'header.php'; ?>

<section class="flex-container">
  <?php
  if (!isset($login))
  {
    ?>
    <h1>Login</h1>
    <form action="includes/login.inc.php<?php echo(isset($_GET['page']))?"?page=".$_GET['page']."":""?>" method="post">
      <input class="text-box" type="email" id="email" name="email" placeholder="E-mail" required
        value="<?php if(isset($_GET['email'])){echo $_GET['email'];}elseif(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>"><br>
      <input class="text-box" type="password" id="password" name="password" placeholder="Password" required
        value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>"><br>
      <label for="remember">Remember Login:</label>
      <input type="checkbox" id="remember" name="remember" <?php if(isset($_GET['remember'])){echo 'checked';}?>>
      <input class="a-btn" type="submit" value="Login">
    </form>
    <p style="margin: 0 0 10px 0;">Don't have an account?: <a class="a-btn" href="signup.php">Register</a></p>
    <?php
    // Login notifications
    if (isset($_GET['login']))
      switch ($_GET['login'])
      {
        case 'wrongpassword':
          echo "<p class=\"error\">Incorrect password or email!</p>";
          break;
        case 'favorites':
          echo "<p class=\"success\">You must be logged in to like or dislike notes</p>";
      }
  }
  ?>
</section>

<?php include 'browse-notes.php'; ?>

<?php include 'footer.php'; ?>