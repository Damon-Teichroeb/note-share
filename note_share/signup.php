<?php
include 'header.php';
?>

<section class="flex-container">
  <h1>Sign Up</h1>
  <form action="includes/signup.inc.php" method="post">
    <label for="email">Email:</label>
    <input class="text-box" type="email" id="email" name="email" included
      value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
    ><br>
    <label for="name">Name:</label>
    <input class="text-box" type="text" id="name" name="name" included
      value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>"
    ><br>
    <label for="password">Password:</label>
    <input class="text-box" type="password" id="password" name="password" included><br>
    <label for="repassword">Re-Enter Your Password:</label>
    <input class="text-box" type="password" id="repassword" name="repassword" included><br>
    <input class="btn" type="submit" value="Register">
  </form>
  <?php
  // Signup notifications
  if (isset($_GET['signup']))      
    switch ($_GET['signup'])
    {
      case 'invalidemail':
        echo "<p class=\"error\">Please use a valid email.</p>";
        break;
      case 'passwordmismatch':
        echo "<p class=\"error\">Passwords do not match.</p>";
        break;
      case 'duplicateemail':
        echo "<p class=\"error\">That email already exists on this website.</p>";
    }
  ?>
</section>

<?php
include 'footer.php';
?>