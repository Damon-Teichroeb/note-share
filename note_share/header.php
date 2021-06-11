<?php
require 'includes/dbh.inc.php';
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
</head>
<body>
  <header>
    <ul>
      <li><a href="index.php">Dashboard</a></li>
      <li>
        <div id="logout">
          <?php
          if(isset($login))
          {
            $object = $dbh->query("SELECT name FROM users WHERE email = '$login';");
            $names  = $object->fetch_assoc();
            $name   = $names['name'];
          ?>
            <form action="includes/logout.inc.php" method="post">
              <label><?php echo $name; ?>:</label>
              <input type="submit" value="Logout">
            </form>
          <?php
          }
          ?>
        </div>
      </li>
    </ul>
  </header>