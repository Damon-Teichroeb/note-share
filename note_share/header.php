<?php
include 'includes/dbh.inc.php';
session_start();
isset($_SESSION['id']) ? $login = $_SESSION['id'] : $login = null;
$head = basename($_SERVER['REQUEST_URI']);
?>

<html>
<head>
  <title>Note Share</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Varela&display=swap">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onload="listNotes('<?php echo preg_match('/my-notes.php/', $head)?'mynotes':'';?>', '', '', '');"> <!-- This onload is for browse-notes.php -->
  <header>
    <h1>Note Share</h1>
  </header>
  <section class="flex-nav">
    <?php
    if (isset($login))
    {
      $object = $dbh->query("SELECT users_name FROM users WHERE users_id = '$login';");
      $names  = $object->fetch_assoc();
      ?>  
      <a class="nav-btn" href="includes/logout.inc.php"><?php echo $names['users_name'];?>: Logout</a>
      <a class="nav-btn" href="my-notes.php">My Notes</a>
      <a class="nav-btn" href="upload.php">Upload</a>
      <?php
    }
    else
    {
      ?>
      <a class="nav-btn" href="login.php">Login</a>
      <a class="nav-btn" href="signup.php">Register</a>
      <?php
    }
    ?>
    <a class="nav-btn" href="index.php">Home</a>
    <?php
    // Signup notifications
    if (isset($_GET['signup']))
      switch ($_GET['signup'])
      {
        case 'success':
          echo "<p class=\"success\">You have successfully registered an account!</p>";
      }
    // Login notifications
    if (isset($_GET['login']))
      switch ($_GET['login'])
      {
        case 'success':
          echo "<p class=\"success\">You have logged into your account!</p>";
          break;
        case 'logout':
          echo "<p class=\"success\">You have logged out of your account!</p>";
      }
    ?>
  </section>