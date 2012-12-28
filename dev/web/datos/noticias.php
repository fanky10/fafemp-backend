<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR .'/repositories/noticias_repository.php';
@include_once ROOT_DIR .'/entidades/noticia.php';
/**
 * Description of zonas
 *
 * @author fanky
 */
class DataNoticias extends Data implements NoticiasRepository{

    public function __construct() {
        parent::__construct();
    }
    public function getNoticias(){
        $query = "select * from noticias";
        $result = mysql_query($query)
            or die ("Query Failed ".mysql_error());
        $noticia_idx=0;
        $vNews;
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){

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
    public function addNoticia($noticia) {
        return null;
    }
    /**
    public function getZona($id_zona){
        
        $query = "select * from precio_zona_mensajeria pzm".
            " WHERE pzm.id=$id_zona";
        $result = mysql_query($query)
            or die ("<br/>getZona Failed: $query <br/>".mysql_error());
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        $oZona = new Zona();
        
        $nombre = $row['nombre_zona'];
        $precio = $row["precio"];
        
        $oZona->setId($id_zona);
        $oZona->setNombre($nombre);
        $oZona->setPrecio($precio);       
        
        //lo devuelvo :P
        $this->closeDB($connection);
        return $oZona;
    }
     *
     */
}
?>
