<?php
require 'dbh.inc.php';

$email = $_POST['email'];

$to      = "$email";
$subject = 'Reset Password';
$message = 'Please reset your password';
$headers = 'From: noteshare@no-reply.com';

mail($to, $subject, $message, $headers);
?>