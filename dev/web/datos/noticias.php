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
        $query = "select n.noticia_id,n.noticia_fec_hora,n.noticia_titulo,n.noticia_cuerpo,i.imagen_id,i.imagen_path,i.imagen_nombre  
            from noticias n 
            LEFT JOIN imagenes i on i.imagen_id = n.noticia_imagen_id 
            ORDER BY noticia_fec_hora desc limit ?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $limit);

        $stmt->execute();

        $result = $stmt->get_result();

        $noticia_idx = 0;
        $vNews = array();
        while ($row = $result->fetch_assoc()) {

            $oImagen = new Imagen();
            $oImagen->setId($row['imagen_id']);
            $oImagen->setNombre($row['imagen_nombre']);
            $oImagen->setPath($row['imagen_path']);


            $id = $row['noticia_id'];
            $fechaHora = $row['noticia_fec_hora'];
            $titulo = $row['noticia_titulo'];
            $cuerpo = $row['noticia_cuerpo'];
            $oNoticia = new Noticia();
            $oNoticia->setCuerpo($cuerpo);
            $oNoticia->setFechaHora($fechaHora);
            $oNoticia->setId($id);
            $oNoticia->setImagen($oImagen);
            //TODO: imagen / url
            $oNoticia->setTitulo($titulo);

            $vNews[$noticia_idx] = $oNoticia;
            $noticia_idx = $noticia_idx + 1;
        }
        $this->closeDB();
        return $vNews;
    }

    public function getNoticia($titulo) {
        return null;
    }

    public function addNoticia(Noticia $noticia) {
        $imagen = $noticia->getImagen();
        $non_query = "insert into " . Noticia::$TABLE . " (noticia_titulo,noticia_cuerpo,noticia_imagen_id) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssi', $title, $body, $imgId);
        $title = $noticia->getTitulo();
        $cuerpo = $noticia->getCuerpo();
        $body = mysql_real_escape_string($cuerpo);
        if (isset($imagen)) {
            $imgId = $imagen->getId();
        }
        
        if (!$stmt->execute()) {
            echo "addNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }


        /* close statement and connection */
        $stmt->close();
    }

    public function getNoticiaById($id) {

        $query = "select n.noticia_id,n.noticia_fec_hora,n.noticia_titulo,n.noticia_cuerpo,i.imagen_id,i.imagen_path,i.imagen_nombre  
            from noticias n 
            LEFT JOIN imagenes i on i.imagen_id = n.noticia_imagen_id 
            WHERE n.noticia_id= ?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();


        $oNoticia = null;
        $oImagen = null;
        while ($row = $result->fetch_assoc()) {
            if (isset($row['imagen_id'])) {
                $oImagen = new Imagen();
                $oImagen->setId($row['imagen_id']);
                $oImagen->setNombre($row['imagen_nombre']);
                $oImagen->setPath($row['imagen_path']);
            }

            $id = $row['noticia_id'];
            $fechaHora = $row['noticia_fec_hora'];
            $titulo = $row['noticia_titulo'];
            $cuerpo = $row['noticia_cuerpo'];

            $oNoticia = new Noticia();
            $oNoticia->setCuerpo($cuerpo);
            $oNoticia->setFechaHora($fechaHora);
            $oNoticia->setId($id);
            $oNoticia->setImagen($oImagen);
            //TODO: imagen / url
            $oNoticia->setTitulo($titulo);
        }
        $stmt->close();
        return $oNoticia;
    }

    public function getNoticiasPaginadas($offset, $limit) {
        $query = "SELECT SQL_CALC_FOUND_ROWS n.noticia_id,n.noticia_fec_hora,n.noticia_titulo,n.noticia_cuerpo,i.imagen_id,i.imagen_path,i.imagen_nombre  
            from noticias n 
            LEFT JOIN imagenes i on i.imagen_id = n.noticia_imagen_id 
            ORDER BY noticia_fec_hora desc limit ?,?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('ii', $offset, $limit);

        $stmt->execute();

        $result = $stmt->get_result();

        $noticia_idx = 0;
        $vNews = array();
        while ($row = $result->fetch_assoc()) {

            $oImagen = new Imagen();
            $oImagen->setId($row['imagen_id']);
            $oImagen->setNombre($row['imagen_nombre']);
            $oImagen->setPath($row['imagen_path']);


            $id = $row['noticia_id'];
            $fechaHora = $row['noticia_fec_hora'];
            $titulo = $row['noticia_titulo'];
            $cuerpo = $row['noticia_cuerpo'];
            $oNoticia = new Noticia();
            $oNoticia->setCuerpo($cuerpo);
            $oNoticia->setFechaHora($fechaHora);
            $oNoticia->setId($id);
            $oNoticia->setImagen($oImagen);
            //TODO: imagen / url
            $oNoticia->setTitulo($titulo);

            $vNews[$noticia_idx] = $oNoticia;
            $noticia_idx = $noticia_idx + 1;
        }
        $this->closeDB();
        return $vNews;
    }

    public function getCantidadNoticias() {
        $query = "select count(*) as cantidad from " . Noticia::$TABLE;
        $result = $this->mysqli->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$this->mysqli->errno}] {$this->mysqli->error}");
        }
        $row = $result->fetch_assoc();
        return $row['cantidad'];
    }

}

?>
