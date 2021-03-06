<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once 'controlador_imagenes.php';

class ControladorImagenesNoticia extends ControladorImagenes {

    private $noticiaId;

    public function __construct($dirBase, $imgPath) {
        parent::__construct($dirBase, $imgPath);
    }

    protected function getImagenesGuardadas() {
        return $this->manejador->getImagenesNoticia($this->noticiaId);
    }

    protected function saveImage($safe_name, $safe_filename, $orden) {
        $oImagen = new Imagen();
        $oImagen->setNombre($safe_name);
        $oImagen->setNombreArchivo($safe_filename);
        $oImagen->setPath($this->imgPath);
        $oImagen->setOrden($orden);
        $this->manejador->addImagenNoticia($oImagen, $this->noticiaId);
        return $oImagen;
    }

    protected function editOrden($imageId, $imageOrder) {
        //get original img object to see if the id is cool
        $oImage = $this->manejador->getImagen($imageId);
        if (isset($oImage) && !empty($oImage)) {
            $oImage->setOrden($imageOrder);
            $this->manejador->editarImagenNoticia($oImage);
        } else {
            $this->sendJSONResponseMessage("ERROR", "No se pudieron guardar los cambios, avise al administrador o intente nuevamente mas tarde");
        }
    }

    public function setNoticiaId($noticiaId) {
        $this->noticiaId = $noticiaId;
    }

}

?>