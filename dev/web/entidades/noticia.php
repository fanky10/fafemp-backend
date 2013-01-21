<?php

include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';

class Noticia {

    public static $TABLE = "noticias";
    public static $COLUMN_ID = "noticia_id";
    private $id;
    private $fechaHora;
    private $titulo;
    private $cuerpo;
    private $imagenes;

    public function setId($id) {
        $this->id = $id;
    }

    public function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setCuerpo($cuerpo) {
        $this->cuerpo = $cuerpo;
    }

    public function setImagenes($imagenes) {
        $this->imagenes = $imagenes;
    }

    public function getId() {
        return $this->id;
    }

    public function getFechaHora() {
        return $this->fechaHora;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getCuerpo() {
        return $this->cuerpo;
    }

    public function getImagenes() {
        return $this->imagenes;
    }

    public function getImagen() {
        if (isset($this->imagenes)) {
            return $this->imagenes[0];
        }
        return null;
    }

}

?>
