<?php
session_start(); 
$msg = "";
if ($_SESSION['estado'] == true) {
    $msg = "Conectado";
}
else
    $msg = "No conectado";
?>
<html>
    <head><title>Estado de sesion</title></head>
    <body>
        <p style="text-align:center;">Tu estado de sesión es: <b><?= $msg ?></b></p>

    </body>
</html>
