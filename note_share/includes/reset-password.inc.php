<?php
require 'dbh.inc.php';

$email = $_POST['email'];

$to      = "$email";
$subject = 'Reset Password';
$message = 'Please reset your password';
$headers = 'From: damon@noteshare.com';

if(mail($to, $subject, $message, $headers))
  header("Location: ../reset-password.php?reset=success");
else
  echo error_get_last()['message'];
?>