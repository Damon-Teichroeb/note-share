<?php
require 'dbh.inc.php';

$email = $_POST['email'];
$pass  = $_POST['password'];

$object = $dbh->query("SELECT password FROM users WHERE email = '$email';");
$hash   = $object->fetch_assoc();

if (!password_verify($pass, $hash['password']))
{
  if(!empty($_POST["remember"]))
    header("Location: ../login.php?login=wrongpassword&email=".$email."&remember=checked");
  else
    header("Location: ../login.php?login=wrongpassword&email=".$email."");
}
else // Success condition
{ 
  if(!empty($_POST["remember"]))
  {
    setcookie('email', $email, time()+ 3600, '/');
    setcookie('password', $pass, time()+ 3600, '/');
    echo 'Cookies Set Successfuly';
  }
  else
  {
    setcookie('email', '', 1, '/');
    setcookie('password', '', 1, '/');
    echo 'Cookies Not Set';
  }

  session_start();
  $object         = $dbh->query("SELECT id FROM users WHERE email = '$email';");
  $ids            = $object->fetch_row();
  $_SESSION['id'] = $ids[0];
  
  header('Location: ../index.php?login=success');
}
exit;
?>