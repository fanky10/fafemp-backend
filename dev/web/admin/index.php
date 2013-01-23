<?php

session_start();

include_once '../init.php';
include_once ROOT_DIR . '/entidades/usuario.php';
include_once ROOT_DIR . '/repositorios/usuarios_repository.php';
include_once ROOT_DIR . '/mocked/UserServiceMocked.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';

$estadoLogin = $_SESSION['estado'];
$redirectLogin = "noticias.php";// la pagina principal del login! :D
if (isset($estadoLogin) && $estadoLogin) {
    header("Location: ".$redirectLogin);
    return; //everything is just fine! ^^
}

$user = $_POST['user'];
$pass = md5($_POST['pass']);

$manejador = new ManejadorServicios();

$administrador = $manejador->getUsuarios($user);

if (isset($administrador) && $user == $administrador->getUser() && $pass == $administrador->getPass()) {
    $_SESSION['estado'] = true;
    $_SESSION['user'] = $administrador->getUser();
    header("Location: ".$redirectLogin);
} else if ($user != null && $pass != null) {
    header("Location: admin_login.php?msg=error");
} else if ($user == null || $pass == null) {
    header("Location: admin_login.php");
}
?>