<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/reuniones_repository.php';
@include_once ROOT_DIR . '/entidades/reunion.php';
@include_once ROOT_DIR . '/entidades/imagen.php';
@include_once ROOT_DIR . '/util/utilidades.php';

class DataReuniones extends Data implements ReunionesRepository {
    public function addReunion(Reunion $reunion) {
        $non_query = "insert into " . Reunion::$TABLE . " (reunion_fec_ini,reunion_fec_fin,reunion_titulo,reunion_cuerpo) 
            values(?,?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssss', $fecIni,$fecFin,$title, $body);
        $fecIni = $reunion->getFechaInicio();
        $fecFin = $reunion->getFechaFin();
        $title = $reunion->getTitulo();
        $cuerpo = $reunion->getCuerpo();
        $body = $this->realEscapeString($cuerpo);


        if (!$stmt->execute()) {
            echo "addNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        /* close statement and connection */
        $stmt->close();

        $id = $this->getUltimoID(Reunion::$TABLE, Reunion::$COLUMN_ID);
        return $id; //generated id
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
