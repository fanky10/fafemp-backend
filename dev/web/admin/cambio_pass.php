<?php
session_start(); 

include_once '../init.php';
include_once ROOT_DIR . '/entidades/usuario.php';
include_once ROOT_DIR . '/repositorios/usuarios_repository.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';

$manejador=new ManejadorServicios();

$oldPassword=$_POST['old_password'];
$newPassword1=$_POST['new_password1'];
$newPassword2=$_POST['new_password2'];

$usuario=$manejador->getUsuarios($_SESSION['user']);

if ($usuario->getPass()==md5($oldPassword)){
    if ($newPassword1==$newPassword2){
        $manejador->cambioPassword($_SESSION['user'], md5($newPassword1));
        echo "Contraseña modificada correctamente";
    }else echo "Las contraseñas no coinciden";
} else echo "Contraseña antigua incorrecta";

?>
