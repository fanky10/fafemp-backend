<?php

class JSONObject {

    private $nombre;
    private $id;

    public function __construct($id,$nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getId() {
        return $this->id;
    }
    public function toJson() {
        return json_encode(array(
            'id' => $this->getId(),
            'nombre'=> $this->getNombre()
        ));
    }

}

?>
