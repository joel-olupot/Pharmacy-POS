<?php 

session_start();

if(isset($_SESSION['user_id']))
{
  unset($_SESSION['user-id']);
}

header("location: login.php");

?>