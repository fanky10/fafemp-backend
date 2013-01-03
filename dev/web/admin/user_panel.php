<?php
session_start(); 
    $msg="Bienvenido ".$_SESSION['user'];
?>

<html>
<head><title>User Panel</title></head>
<body>
<p> <?php echo $msg; ?> </p>

<form id="form2" name="form2" method="post" action="cambio_pass_form.php">
  <input type="submit" name="cambio_pass" id="logout" value="Cambiar contraseña" />
</form>

<form id="form2" name="form3" method="post" action="logout.php">
  <input type="submit" name="logout" id="logout" value="Desconectarme" />
</form>

</body>
</html>