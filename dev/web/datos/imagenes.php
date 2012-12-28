<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/imagenes_repository.php';
@include_once ROOT_DIR . '/entidades/imagen.php';
@include_once ROOT_DIR . '/util/utilidades.php';

class DataImagenes extends Data implements ImagenesRepository {

    public function __construct() {
        parent::__construct();
    }

    public function getImagenes() {
        return array();
    }

    public function getImagen($id) {
        return null;
    }

    public function addImagen(Imagen $imagen) {
        $non_query = "insert into ".Imagen::$TABLE." (imagen_path,imagen_nombre) values(" .
                Utilidades::db_adapta_string($imagen->getPath()) . "," .
                Utilidades::db_adapta_string($imagen->getNombre()) .
                ")";
        //lo insertamos
        $results = mysql_query($non_query)
                or die("Query Failed " . mysql_error());
        $id = -1;
        $id = $this->getUltimoID(Imagen::$TABLE,Imagen::$COLUMN_ID);
        return $id; //returns generated id
    }

}

?>
