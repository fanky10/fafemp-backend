<?php

@include_once 'init.php';
@include_once ROOT_DIR . '/mocked/noticias.php';
@include_once ROOT_DIR . '/datos/imagenes.php';
@include_once ROOT_DIR . '/datos/noticias.php';
@include_once ROOT_DIR . '/mocked/UserServiceMocked.php';
@include_once ROOT_DIR . '/datos/usuarios.php';


class ManejadorServicios {

    private $noticiasRepository;
    private $imagenesRepository;
    private $usuariosRepository;

    public function __construct() {
        
    }

    public function getNoticias($limit) {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->getNoticias($limit);
    }

    public function addNoticia(Noticia $noticia) {
        $imagen = new Imagen();
        $imagen = $noticia->getImagen();
        $this->imagenesRepository = new DataImagenes();
        $idImagen = $this->imagenesRepository->addImagen($imagen);
        $imagen->setId($idImagen);
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->addNoticia($noticia);
    }

    public function getNoticiaById($id) {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->getNoticiaById($id);
    }

    
    public function getUsuarios($user){
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->getUsuario($user);
    }
}

?>
