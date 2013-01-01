<?php
 session_start();
  unset($_SESSION["estado"]); 
  session_destroy();
  header("Location: index.php");
?>
