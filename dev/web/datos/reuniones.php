<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/reuniones_repository.php';
@include_once ROOT_DIR . '/entidades/reunion.php';
@include_once ROOT_DIR . '/entidades/imagen.php';
@include_once ROOT_DIR . '/util/utilidades.php';

class DataNoticias extends Data implements ReunionesRepository {
    public function addReunion(Reunion $reunion) {
        
    }

    public function getCantidadReuniones() {
        
    }

    public function getReunionById($id) {
        
    }

    public function getReuniones($limit) {
        
    }

    public function getReunionesPaginadas($offset, $limit) {
        
    }
}
?>
