<?php

class Documento {

    public static $TABLE = "documentos";
    public static $COLUMN_ID = "documento_id";
    private $id;
    private $nombre;
    private $nombreArchivo;
    private $path;
    private $fechaHora;
    private $eliminada;
    private $orden;

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
    }

    public function setEliminada($eliminada) {
        $this->eliminada = $eliminada;
    }

    public function setNombreArchivo($nombreArchivo) {
        $this->nombreArchivo = $nombreArchivo;
    }
    
    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPath() {
        return $this->path;
    }

    public function getFechaHora() {
        return $this->fechaHora;
    }

    public function getEliminada() {
        return $this->eliminada;
    }

    public function getNombreArchivo() {
        return $this->nombreArchivo;
    }
    public function getOrden() {
        return $this->orden;
    }
}

?>
