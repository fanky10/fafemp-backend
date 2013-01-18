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
        $non_query = "insert into " . Imagen::$TABLE . " (imagen_path,imagen_nombre) 
            values(?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ss', $path, $name);

        $name = $imagen->getNombre();
        $path = $imagen->getPath();

        if (!$stmt->execute()) {
            echo "addImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $stmt->close();
        $id = $this->getUltimoID(Imagen::$TABLE, Imagen::$COLUMN_ID);

        return $id; //returns generated id
    }

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $non_query = "insert into " . Imagen::$TABLE . " (imagen_path,imagen_nombre,imagen_noticia_id) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('ssi', $path, $name, $noticiaId)) {
            echo "addImagen - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }


        $name = $imagen->getNombre();
        $path = $imagen->getPath();

        if (!$stmt->execute()) {
            echo "addImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $stmt->close();
        $id = $this->getUltimoID(Imagen::$TABLE, Imagen::$COLUMN_ID);

        return $id; //returns generated id
    }

}

?>
