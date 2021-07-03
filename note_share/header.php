<?php
include 'includes/dbh.inc.php';

session_start();
if (isset($_SESSION['id']))
  $login = $_SESSION['id'];
else
  $login = null;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Niwe-Hustle</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Varela&display=swap">
</head>
<body>
  <header class="nav">
    <?php
    if (isset($login))
    {
      $object = $dbh->query("SELECT users_name FROM users WHERE users_id = '$login';");
      $names  = $object->fetch_assoc();
      $name   = $names['users_name'];
      ?>  
      <a class="btn" href="includes/logout.inc.php"><?php echo $name;?>: Logout</a>
      <a class="btn" href="upload.php?">Upload</a>
      <?php
    }
    else
    {
      ?>
      <a class="btn" href="login.php">Login</a>
      <a class="btn" href="signup.php">Register</a>
      <?php
    }
    ?>
    <a class="btn" href="index.php">Home</a>
    <?php
    // Signup notifications
    if (isset($_GET['signup']))
      switch ($_GET['signup'])
      {
        case 'success':
          echo "<p class=\"success\">You have successfully registered an account!</p>";
          break;
      }
      
    // Login notifications
    if (isset($_GET['login']))
      switch ($_GET['login'])
      {
        case 'success':
          echo "<p class=\"success\">You have successfully logged into your account!</p>";
          break;
      }
    ?>
  </header>