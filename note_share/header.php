<?php
include 'includes/dbh.inc.php';
session_start();

if (isset($_SESSION['email']))
  $login = $_SESSION['email'];
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
      $object = $dbh->query("SELECT name FROM users WHERE email = '$login';");
      $names  = $object->fetch_assoc();
      $name   = $names['name'];
    ?>  
      <a class="btn" href="includes/logout.inc.php"><?php echo $name;?>: Logout</a>
      <a class="btn" href="upload.php">Upload</a>
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
    <a class="btn" href="browse.php">Browse</a>
    <a class="btn" href="index.php">Home</a>
    <?php
    // Signup notification
    if (isset($_GET['signup']))
      switch ($_GET['signup'])
      {
        case 'success':
          echo "<p class=\"success\">You have successfuly registered an account!</p>";
          break;
      }
      
    // Login notification
    if (isset($_GET['login']))
      switch ($_GET['login'])
      {
        case 'success':
          echo "<p class=\"success\">You have successfuly logged in to your account!</p>";
          break;
      }
    ?>
  </header>