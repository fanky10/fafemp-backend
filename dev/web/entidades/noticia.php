<?php

class Noticia {

    private $id;
    private $fechaHora;
    private $titulo;
    private $cuerpo;
    private $imagen;
    private $url;

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

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function setUrl($url) {
        $this->url = $url;
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

    public function getImagen() {
        return $this->imagen;
    }

    public function getUrl() {
        return $this->url;
    }

}

?>
