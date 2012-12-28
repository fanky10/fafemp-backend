<?php

class Imagen {
    public static $TABLE = "imagenes";
    
    public static $COLUMN_ID = "imagen_id";
    private $id;
    private $nombre;
    private $path;

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPath($path) {
        $this->path = $path;
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

}

?>
