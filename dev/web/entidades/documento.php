<?php

class Imagen {

    public static $TABLE = "documentos";
    public static $COLUMN_ID = "documento_id";
    private $id;
    private $nombre;
    private $archivo;
    private $tipo;
    private $orden;

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
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

    public function getTipo() {
        return $this->tipo;
    }

	public function getTipo() {
        return $this->tipo;
    }
    
    public function getOrden() {
        return $this->orden;
    }
}

?>
