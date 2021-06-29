<?php
require 'dbh.inc.php';

$email  = $_POST['email'];
$name   = $_POST['name'];
$pass   = $_POST['password'];
$repass = $_POST['repassword'];

$object = $dbh->query("SELECT email FROM users WHERE email = '$email';");
$exists = $object->fetch_assoc();

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
  header("Location: ../signup.php?signup=invalidemail&name=".$name."");
}
else if ($pass !== $repass)
{
  header("Location: ../signup.php?signup=passwordmismatch&name=".$name."&email=".$email."");
}
else if (!empty($exists['email']))
{
  header("Location: ../signup.php?signup=duplicateemail&name=".$name."");
}
else // Success condition
{
  $hash = password_hash($pass, PASSWORD_DEFAULT);
  $dbh->query("INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$hash');");
  
  header("Location: ../index.php?signup=success");
}
exit;
?>