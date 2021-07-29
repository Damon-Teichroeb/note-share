<?php
include 'dbh.inc.php';

$email = $dbh->real_escape_string($_POST['email']);
$pass  = $dbh->real_escape_string($_POST['password']);

$object = $dbh->query("SELECT users_password FROM users WHERE users_email = '$email';");
$hash   = $object->fetch_assoc();

if (!password_verify($pass, $hash['users_password']))
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
  $object         = $dbh->query("SELECT users_id FROM users WHERE users_email = '$email';");
  $ids            = $object->fetch_row();
  $_SESSION['id'] = $ids[0];
  
  if (isset($_GET['page']))
    switch ($_GET['page'])
    {
      case 'upload':
        header('Location: ../upload.php?login=success');
        break;
      case 'mynotes':
        header('Location: ../my-notes.php?login=success');
    }
  else
    header('Location: ../index.php?login=success');
}
exit;
?>