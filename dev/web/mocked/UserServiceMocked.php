<?php
@include_once '../init.php';
@include_once ROOT_DIR . '/entidades/usuarios.php';
@include_once ROOT_DIR . '/repositorios/usuarios_repository.php';

class UserServiceMocked implements UsuariosRepository {
    
    public function getUsuario($user) {
        return new User("admin", "admin");
    }

    public function cambioPassword($user, $newPassword) {
        //nada
    }

}

?>
