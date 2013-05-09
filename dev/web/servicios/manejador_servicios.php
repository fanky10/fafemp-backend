<?php

@include_once 'init.php';
@include_once ROOT_DIR . '/mocked/noticias.php';
@include_once ROOT_DIR . '/datos/imagenes.php';
@include_once ROOT_DIR . '/datos/noticias.php';
@include_once ROOT_DIR . '/datos/reuniones.php';
@include_once ROOT_DIR . '/mocked/UserServiceMocked.php';
@include_once ROOT_DIR . '/datos/usuarios.php';

class ManejadorServicios {

    private $noticiasRepository;
    private $imagenesRepository;
    private $usuariosRepository;
    private $reunionesRepository;

    public function __construct() {
        
    }

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $this->imagenesRepository = new DataImagenes();
        $idImagen = $this->imagenesRepository->addImagenNoticia($imagen, $noticiaId);
        $imagen->setId($idImagen);
    }

    public function editarNoticia(Noticia $oNoticia) {
        $this->noticiasRepository = new DataNoticias();
        $this->noticiasRepository->editarNoticia($oNoticia);
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

    public function editarImagenNoticia(Imagen $oImagen) {
        $this->imagenesRepository = new DataImagenes();
        $this->imagenesRepository->editarImagenNoticia($oImagen);
    }

    public function getImagen($idImagen) {
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->getImagen($idImagen);
    }

    private function asignaImagenesNoticia($oNoticia) {
        if (!isset($oNoticia)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesNoticia($oNoticia->getId());
        $oNoticia->setImagenes($vImagenes);

        $imagenSlider = $this->imagenesRepository->getImgSliderNoticia($oNoticia->getId());
        $oNoticia->setImagenSlider($imagenSlider);
    }

    private function asignaImagenesNoticias($vNoticias) {
        if (!isset($vNoticias) || empty($vNoticias)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $oNoticia = new Noticia();
        foreach ($vNoticias as $oNoticia) {
            $vImagenes = $this->imagenesRepository->getImagenesNoticia($oNoticia->getId());
            $oNoticia->setImagenes($vImagenes);

            $imagenSlider = $this->imagenesRepository->getImgSliderNoticia($oNoticia->getId());
            $oNoticia->setImagenSlider($imagenSlider);
        }
    }

    public function getImagenesNoticia($noticiaId) {
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesNoticia($noticiaId);
        return $vImagenes;
    }

    public function getReunionById($reunionId) {
        $this->reunionesRepository = new DataReuniones();
        $oReunion = $this->reunionesRepository->getReunionById($reunionId);
        $this->asignaImagenesReunion($oReunion);
        return $oReunion;
    }

    public function getReuniones($limit) {
        $this->reunionesRepository = new DataReuniones();
        $vReuniones = $this->reunionesRepository->getReuniones($limit);
        $this->asignaImagenesReuniones($vReuniones);
        return $vReuniones;
    }

    public function addReunion(Reunion $reunion) {
        $this->reunionesRepository = new DataReuniones();
        return $this->reunionesRepository->addReunion($reunion);
    }

    public function editarReunion(Reunion $reunion) {
        $this->reunionesRepository = new DataReuniones();
        return $this->reunionesRepository->editarReunion($reunion);
    }

    public function eliminarImagen(Imagen $imagen) {
        $imagen->setEliminada(1);
        $this->imagenesRepository = new DataImagenes();
        $this->imagenesRepository->editarImagen($imagen);
    }

    public function getImagenesReunion($reunionId) {
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->getImagenesReunion($reunionId);
    }

    public function addImagenReunion(Imagen $imagen, $reunionId) {
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->addImagenReunion($imagen, $reunionId);
    }

    public function editarImagenReunion(Imagen $imagen) {
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->editarImagenReunion($imagen);
    }

    private function asignaImagenesReunion($oReunion) {
        if (!isset($oReunion)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesReunion($oReunion->getId());
        $oReunion->setImagenes($vImagenes);
    }

    private function asignaImagenesReuniones($vReuniones) {
        if (!isset($vReuniones) || empty($vReuniones)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $oReunion = new Reunion();
        foreach ($vReuniones as $oReunion) {
            $vImagenes = $this->imagenesRepository->getImagenesReunion($oReunion->getId());
            $oReunion->setImagenes($vImagenes);
        }
    }

    public function addImagen(Imagen $imagen) {
        $this->imagenesRepository->addImagen($imagen);
    }

    public function setImgSliderNoticia($noticiaId, $imagenId) {
        $this->imagenesRepository->setImgSliderNoticia($noticiaId, $imagenId);
    }

}

?>