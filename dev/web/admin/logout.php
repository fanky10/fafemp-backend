<?php

session_start();
unset($_SESSION["estado"]);
session_destroy();
header("Location: admin_login.php");
?>
