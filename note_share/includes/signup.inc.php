<?php
include 'dbh.inc.php';

$email  = $dbh->real_escape_string($_POST['email']);
$name   = $dbh->real_escape_string($_POST['name']);
$pass   = $dbh->real_escape_string($_POST['password']);
$repass = $dbh->real_escape_string($_POST['repassword']);

// Error checking
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  header("Location: ../signup.php?signup=invalidemail&name=".$name."");
elseif (!preg_match('/^[-0-9A-Z_\.\s]+$/i', $name))
  header("Location: ../signup.php?signup=invalidname&email=".$email."");
elseif ($pass !== $repass)
  header("Location: ../signup.php?signup=passwordmismatch&name=".$name."&email=".$email."");
elseif (!empty($dbh->query("SELECT users_email FROM users WHERE users_email = '$email';")->fetch_row()))
  header("Location: ../signup.php?signup=duplicateemail&name=".$name."");
else // Success condition
{
  $hash = password_hash($pass, PASSWORD_DEFAULT);
  $dbh->query("INSERT INTO users (users_email, users_name, users_password) VALUES ('$email', '$name', '$hash');");
  
  header("Location: ../index.php?signup=success");
}
exit;
?>