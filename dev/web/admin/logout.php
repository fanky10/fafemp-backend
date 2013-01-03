<?php

session_start();
unset($_SESSION["estado"]);
session_destroy();
header("Location: login_admin.php");
?>
