<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/noticias_repository.php';
@include_once ROOT_DIR . '/entidades/noticia.php';
@include_once ROOT_DIR . '/entidades/imagen.php';
@include_once ROOT_DIR . '/util/utilidades.php';

/**
 * Noticias
 *
 * @author fanky
 */
class DataNoticias extends Data implements NoticiasRepository {

    public function __construct() {
        parent::__construct();
    }

    public function getNoticias($limit) {
        $query = "select n.noticia_id,n.noticia_fec_hora,n.noticia_titulo,n.noticia_cuerpo,n.noticia_eliminada
            from noticias n WHERE n.noticia_eliminada=0
            ORDER BY noticia_fec_hora desc limit ?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $limit);

        $stmt->execute();

        $result = $stmt->get_result();

        $noticia_idx = 0;
        $vNews = array();
        while ($row = $result->fetch_assoc()) {

            $oNoticia = $this->generaNoticia($row);

            $vNews[$noticia_idx] = $oNoticia;
            $noticia_idx = $noticia_idx + 1;
        }
        $stmt->close();
        return $vNews;
    }

    public function getNoticia($titulo) {
        return null;
    }

    public function addNoticia(Noticia $noticia) {
        $non_query = "insert into " . Noticia::$TABLE . " (noticia_titulo,noticia_cuerpo) 
            values(?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ss', $title, $body);
        $title = $noticia->getTitulo();
        $cuerpo = $noticia->getCuerpo();
        $body = $this->realEscapeString($cuerpo);


        if (!$stmt->execute()) {
            echo "addNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        /* close statement and connection */
        $stmt->close();

        $id = $this->getUltimoID(Noticia::$TABLE, Noticia::$COLUMN_ID);
        return $id; //generated id
    }

    public function getNoticiaById($id) {

        $query = "select n.noticia_id,n.noticia_fec_hora,n.noticia_titulo,n.noticia_cuerpo,n.noticia_eliminada
            from noticias n 
            WHERE n.noticia_id= ?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();


        $oNoticia = null;
        while ($row = $result->fetch_assoc()) {

            $oNoticia = $this->generaNoticia($row);
        }
        $stmt->close();
        return $oNoticia;
    }

    public function getNoticiasPaginadas($offset, $limit) {
        $query = "SELECT SQL_CALC_FOUND_ROWS n.noticia_id,n.noticia_fec_hora,n.noticia_titulo,n.noticia_cuerpo,n.noticia_eliminada
            from noticias n WHERE n.noticia_eliminada=0
            ORDER BY noticia_fec_hora desc limit ?,?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('ii', $offset, $limit);

        $stmt->execute();

        $result = $stmt->get_result();

        $noticia_idx = 0;
        $vNews = array();
        while ($row = $result->fetch_assoc()) {
            $oNoticia = $this->generaNoticia($row);

            $vNews[$noticia_idx] = $oNoticia;
            $noticia_idx = $noticia_idx + 1;
        }
        $stmt->close();
        return $vNews;
    }

    public function getCantidadNoticias() {
        $query = "select count(*) as cantidad from " . Noticia::$TABLE. " where noticia_eliminada=0";
        $result = $this->mysqli->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$this->mysqli->errno}] {$this->mysqli->error}");
        }
        $row = $result->fetch_assoc();
        return $row['cantidad'];
    }

    public function editarNoticia(Noticia $noticia) {
        $non_query = "update " . Noticia::$TABLE . " set noticia_titulo=?, noticia_cuerpo=?, noticia_eliminada=? where noticia_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssii', $title, $body, $eliminada, $noticiaId);

        $title = $noticia->getTitulo();
        $cuerpo = $noticia->getCuerpo();
        $body = $this->realEscapeString($cuerpo);
        $eliminada = $noticia->getEliminada();
        $noticiaId = $noticia->getId();

        if (!$stmt->execute()) {
            echo "addNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        /* close statement and connection */
        $stmt->close();
    }

    private function generaNoticia($row) {
        $id = $row['noticia_id'];
        $fechaHora = $row['noticia_fec_hora'];
        $titulo = $row['noticia_titulo'];
        $cuerpo = $row['noticia_cuerpo'];
        $eliminada = $row['noticia_eliminada'];

        $oNoticia = new Noticia();
        $oNoticia->setCuerpo($cuerpo);
        $oNoticia->setFechaHora($fechaHora);
        $oNoticia->setId($id);
        $oNoticia->setTitulo($titulo);
        $oNoticia->setEliminada($eliminada);
        return $oNoticia;
    }

}

?>
