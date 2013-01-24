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

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $non_query = "insert into " . Imagen::$TABLE . " (imagen_path,imagen_nombre,imagen_nombre_archivo,imagen_orden,imagen_noticia_id) 
            values(?,?,?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('sssii', $path, $name,$nombreArchivo, $orden,$noticiaId)) {
            echo "addImagen - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }


        $name = $imagen->getNombre();
        $nombreArchivo = $imagen->getNombreArchivo();
        $path = $imagen->getPath();
        $orden = $imagen->getOrden();

        if (!$stmt->execute()) {
            echo "addImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $stmt->close();
        $id = $this->getUltimoID(Imagen::$TABLE, Imagen::$COLUMN_ID);

        return $id; //returns generated id
    }

    public function getImagenesNoticia($noticiaId) {
        $query = "select imagen_id,imagen_path,imagen_nombre,imagen_fec_hora,imagen_eliminada,imagen_nombre_archivo,imagen_orden FROM " . Imagen::$TABLE . 
                " WHERE imagen_noticia_id= ? and imagen_eliminada=0".
                " ORDER BY imagen_orden";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $noticiaId);

        $stmt->execute();

        $result = $stmt->get_result();


        $img_idx = 0;
        $vImagenes = array();
        while ($row = $result->fetch_assoc()) {
            $oImagen = $this->createImageObject($row);
            $vImagenes[$img_idx] = $oImagen;
            $img_idx++;
        }
        return $vImagenes;
    }

    private function createImageObject($row) {
        $oImagen = new Imagen();
        $id = $row['imagen_id'];
        $imgPath = $row['imagen_path'];
        $imgNombre = $row['imagen_nombre'];
        $imgNombreArchivo = $row['imagen_nombre_archivo'];
        $imgFecHora = $row['imagen_fec_hora'];
        $imgEliminada = $row['imagen_eliminada'];
        $imgOrden = $row['imagen_orden'];
        $oImagen->setId($id);
        $oImagen->setNombre($imgNombre);
        $oImagen->setPath($imgPath);
        $oImagen->setNombreArchivo($imgNombreArchivo);
        $oImagen->setEliminada($imgEliminada);
        $oImagen->setFechaHora($imgFecHora);
        $oImagen->setOrden($imgOrden);
        return $oImagen;
    }

}

?>
