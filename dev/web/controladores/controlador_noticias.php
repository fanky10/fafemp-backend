<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';

class ControladorNoticias {

    protected $manejador;

    public function __construct() {
        $this->manejador = new ManejadorServicios();
    }

    public function editarNoticia($noticiaId) {
        $oNoticia = new Noticia();
        $oNoticia = $this->manejador->getNoticiaById($noticiaId);
        //primero chequeo que quiero editar la noticia correcta
        if (isset($oNoticia) && !empty($oNoticia)) {
            $oNoticia->setCuerpo($_POST['cuerpo']);
            $oNoticia->setTitulo($_POST['titulo']);
            $this->manejador->editarNoticia($oNoticia);
        }
        return $oNoticia;
    }

    public function eliminarNoticia($noticiaId) {
        $oNoticia = new Noticia();
        $oNoticia = $this->manejador->getNoticiaById($noticiaId);
        //primero chequeo que quiero editar la noticia correcta
        if (isset($oNoticia) && !empty($oNoticia)) {
            $oNoticia->setEliminada(1);
            $this->manejador->editarNoticia($oNoticia);
        }
    }

    public function subirNoticia() {
        $oNoticia = new Noticia();
        $oNoticia = $this->agregaNoticia();

        return $oNoticia;
    }

    private function agregaNoticia() {
        $oNoticia = new Noticia();
        $oNoticia->setCuerpo($_POST['cuerpo']);
        $oNoticia->setTitulo($_POST['titulo']);
        $oNoticia->setId(1);
        //TODO: agregar la noticia -> setID
        $nuevoId = $this->manejador->addNoticia($oNoticia);
        $oNoticia->setId($nuevoId);
        return $oNoticia;
    }

}

?>