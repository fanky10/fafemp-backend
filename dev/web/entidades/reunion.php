<?php

include_once '../init.php';
include_once ROOT_DIR .'/util/utilidades.php';

class Reunion {
    public static $TABLE = "reuniones";
    public static $COLUMN_ID = "reunion_id";
    private $id;
    private $fechaInicio;
    private $fechaFin;
    private $titulo;
    private $cuerpo;
    private $imagenes;
    private $eliminada;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin() {
        return $this->fechaFin;
    }

    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getCuerpo() {
        return $this->cuerpo;
    }

    public function setCuerpo($cuerpo) {
        $this->cuerpo = $cuerpo;
    }

    public function getImagenes() {
        return $this->imagenes;
    }

    public function setImagenes($imagenes) {
        $this->imagenes = $imagenes;
    }
    
    public function getImagen() {
        if (isset($this->imagenes) && !empty($this->imagenes)) {
            return $this->imagenes[0];
        }
        return null;
    }
    public function getEliminada(){
        return $this->eliminada;
    }

    public function setEliminada($eliminada) {
        $this->eliminada = $eliminada;
    }


    
}

?>
