<?php 
	print_r($_SESSION['usename']);
  session_start();
  unset($_SESSION['usename']); 
  session_destroy();
  header( "Location: login.php");
  // exit;
?>