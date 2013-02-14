<?php
include_once '../entidades/evento.php';
include_once '../repositorios/eventos_repository.php';

class EventosMocked implements EventosRepository {
    
    public function getEventos() {
        $arrayEventos = array (
            'evento1' => new evento(1, "titulo1", "2013-02-12", "2013-02-13", "http://www.google.com.ar"),
            'evento2' => new evento(2, "titulo2", "2013-02-16", "2013-02-18", "http://www.yahoo.com.ar")
        );
        return $arrayEventos;
    }

}

?>
