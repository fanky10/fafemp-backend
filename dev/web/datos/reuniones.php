<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/reuniones_repository.php';
@include_once ROOT_DIR . '/entidades/reunion.php';
@include_once ROOT_DIR . '/entidades/imagen.php';
@include_once ROOT_DIR . '/util/utilidades.php';

class DataReuniones extends Data implements ReunionesRepository {

    public function __construct() {
        parent::__construct();
    }

    public function addReunion(Reunion $reunion) {
        $non_query = "insert into " . Reunion::$TABLE . " (reunion_fec_ini,reunion_fec_fin,reunion_titulo,reunion_cuerpo) 
            values(?,?,?,?)";
        $stmt = $this->prepareStmt($non_query);

        $stmt->bind_param('ssss', $fecIni, $fecFin, $title, $body);
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

    public function getReunionById($id) {
        $query = "select r.reunion_id,r.reunion_titulo,r.reunion_cuerpo,r.reunion_fec_ini,r.reunion_fec_fin,r.reunion_eliminada
            from reuniones r 
            WHERE r.reunion_id= ?";

        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $oReunion = null;
        while ($row = $result->fetch_assoc()) {
            $oReunion = $this->generaReunion($row);
        }
        $stmt->close();

        return $oReunion;
    }

    public function getReuniones($limit) {
        $query = "select r.reunion_id,r.reunion_titulo,r.reunion_cuerpo,r.reunion_fec_ini,r.reunion_fec_fin,r.reunion_eliminada
            FROM reuniones r 
            WHERE r.reunion_eliminada=0
            ORDER BY r.reunion_fec_ini LIMIT ?";

        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $reunion_idx = 0;
        $vReuniones = array();
        while ($row = $result->fetch_assoc()) {
            $oReunion = $this->generaReunion($row);
            $vReuniones[$reunion_idx] = $oReunion;
            $reunion_idx = $reunion_idx + 1;
        }
        $stmt->close();

        return $vReuniones;
    }

    private function generaReunion($row) {
        $reunion = new Reunion();
        $reunion->setCuerpo($row['reunion_cuerpo']);
        $reunion->setEliminada($row['reunion_eliminada']);
        $reunion->setFechaFin($row['reunion_fec_fin']);
        $reunion->setFechaInicio($row['reunion_fec_ini']);
        $reunion->setId($row['reunion_id']);
        $reunion->setTitulo($row['reunion_titulo']);

        return $reunion;
    }

    public function editarReunion(Reunion $reunion) {
        $non_query = "update " . Reunion::$TABLE . " set reunion_titulo=?, reunion_cuerpo=?, reunion_eliminada=?,reunion_fec_ini=?,reunion_fec_fin=? where reunion_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssissi', $title, $body, $eliminada, $fecIni, $fecFin, $id);

        $fecIni = $reunion->getFechaInicio();
        $fecFin = $reunion->getFechaFin();
        $title = $reunion->getTitulo();
        $eliminada = $reunion->getEliminada();
        $cuerpo = $reunion->getCuerpo();
        $body = $this->realEscapeString($cuerpo);

        $id = $reunion->getId();

        if (!$stmt->execute()) {
            echo "addNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        /* close statement and connection */
        $stmt->close();
    }

}

?>
