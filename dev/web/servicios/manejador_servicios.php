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

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $this->imagenesRepository = new DataImagenes();
        $idImagen = $this->imagenesRepository->addImagenNoticia($imagen,$noticiaId);
        $imagen->setId($idImagen);
    }

    public function addNoticia(Noticia $noticia) {
        $imagen = $noticia->getImagen();
        if (isset($imagen)) {
            $this->imagenesRepository = new DataImagenes();
            $idImagen = $this->imagenesRepository->addImagen($imagen);
            $imagen->setId($idImagen);
        }
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->addNoticia($noticia);
    }

    public function getNoticiaById($id) {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->getNoticiaById($id);
    }

    public function getNoticiasPaginadas($offset, $limit) {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->getNoticiasPaginadas($offset, $limit);
    }

    public function getCantidadNoticias() {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->getCantidadNoticias();
    }

    public function getUsuarios($user) {
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->getUsuario($user);
    }

    public function cambioPassword($user, $newPassword) {
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->cambioPassword($user, $newPassword);
    }

}

?>