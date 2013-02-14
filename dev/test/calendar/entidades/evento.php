<?php

class evento {
    private $id;
    private $titulo;
    private $inicio;
    private $fin;
    private $url;
    
    function __construct($id, $titulo, $inicio, $fin, $url) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->inicio = $inicio;
        $this->fin = $fin;
        $this->url = $url;
    }

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function setInicio($inicio) {
        $this->inicio = $inicio;
    }

    public function getFin() {
        return $this->fin;
    }

    public function setFin($fin) {
        $this->fin = $fin;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }


}

?>
