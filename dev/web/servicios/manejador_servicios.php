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

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $this->imagenesRepository = new DataImagenes();
        $idImagen = $this->imagenesRepository->addImagenNoticia($imagen, $noticiaId);
        $imagen->setId($idImagen);
    }

    public function addNoticia(Noticia $noticia) {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->addNoticia($noticia);
    }

    public function getNoticiaById($id) {
        $this->noticiasRepository = new DataNoticias();
        $oNoticia = $this->noticiasRepository->getNoticiaById($id);
        $this->asignaImagenesNoticia($oNoticia);
        return $oNoticia;
    }

    public function getNoticiasPaginadas($offset, $limit) {
        $this->noticiasRepository = new DataNoticias();
        $vNoticias = $this->noticiasRepository->getNoticiasPaginadas($offset, $limit);
        $this->asignaImagenesNoticias($vNoticias);
        return $vNoticias;
    }

    public function getNoticias($limit) {
        $this->noticiasRepository = new DataNoticias();
        $vNoticias = $this->noticiasRepository->getNoticias($limit);
        $this->asignaImagenesNoticias($vNoticias);
        return $vNoticias;
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

    private function asignaImagenesNoticia(Noticia $oNoticia) {
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesNoticia($oNoticia->getId());
        $oNoticia->setImagenes($vImagenes);
    }

    private function asignaImagenesNoticias($vNoticias) {
        $this->imagenesRepository = new DataImagenes();
        $oNoticia = new Noticia();
        foreach ($vNoticias as $oNoticia) {
            $vImagenes = $this->imagenesRepository->getImagenesNoticia($oNoticia->getId());
            $oNoticia->setImagenes($vImagenes);
        }
    }

}

?>