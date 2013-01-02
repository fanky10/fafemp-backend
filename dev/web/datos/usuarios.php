<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/usuarios_repository.php';
@include_once ROOT_DIR . '/entidades/usuarios.php';

class DataUsuarios extends Data implements UsuariosRepository {

    function __construct() {
     parent::__construct();   
    }

    
    public function getUsuario($user) {        
        $query = "select u.usuario_user, u.usuario_pass
                   from usuarios u
                   where u.usuario_user= ? ";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('s', $user);

        $stmt->execute();

        $result = $stmt->get_result();

        $usuario = null;

        while ($row = $result->fetch_assoc()) {
            $usuario = new User("","");

            $usuario->setUser($row['usuario_user']);

            $usuario->setPass($row['usuario_pass']);
        };
        $stmt->close();
        return $usuario;
    }
    
    public function cambioPassword($user,$newPassword){
        $query="update usuarios set usuario_pass= ? where usuario_user = ?";    
        
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('ss', $newPassword,$user);

        $stmt->execute();
    }

}

?>
