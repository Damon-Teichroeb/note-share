<?php
require 'header.php';
?>

<div id="signup">
  <h1>Signup</h1>
  <form action="includes/signup.inc.php" method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required
      value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
    ><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required
      value="<?php if(isset($_GET['name'])){echo $_GET['name'];}?>"
    ><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="repassword">Re-Enter Your Password:</label>
    <input type="password" id="repassword" name="repassword" required><br>
    <input type="submit" value="Register">
  </form>
  <?php
  // Signup error messages
  if (isset($_GET['signup']))      
    switch ($_GET['signup'])
    {
      case 'invalidemail':
        echo "<p id=\"error\">Please use a valid email.</p>";
        break;
      case 'passwordmismatch':
        echo "<p id=\"error\">Passwords do not match.</p>";
        break;
      case 'duplicateemail':
        echo "<p id=\"error\">That email already exists on this website.</p>";
        break;
    }
  ?>
</div>

<?php
require 'footer.php';
?>