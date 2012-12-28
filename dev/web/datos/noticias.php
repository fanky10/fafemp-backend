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

    public function getNoticias() {
        $query = "select * from noticias";
        $result = mysql_query($query)
                or die("Query Failed " . mysql_error());
        $noticia_idx = 0;
        $vNews;
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

            $id = $row['noticia_id'];
            $fechaHora = $row['noticia_fec_hora'];
            $titulo = $row['noticia_titulo'];
            $cuerpo = $row['noticia_cuerpo'];
            $oNoticia = new Noticia();
            $oNoticia->setCuerpo($cuerpo);
            $oNoticia->setFechaHora($fechaHora);
            $oNoticia->setId($id);
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
        $imagen = new Imagen();
        $imagen = $noticia->getImagen();
        $non_query = "insert into " . Noticia::$TABLE . " (noticia_titulo,noticia_cuerpo,noticia_imagen_id,noticia_url) values(" .
                Utilidades::db_adapta_string($noticia->getTitulo()) . "," .
                Utilidades::db_adapta_string($noticia->getCuerpo()) . "," .
                Utilidades::db_adapta_string($imagen->getId()) . 
                ")";
        //lo insertamos
        $results = mysql_query($non_query)
                or die("Query Failed " . mysql_error());
        //add imagen, get id, then
    }

}

?>
