<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/imagenes_repository.php';
@include_once ROOT_DIR . '/entidades/imagen.php';
@include_once ROOT_DIR . '/entidades/imagen_noticia.php';
@include_once ROOT_DIR . '/entidades/imagen_reunion.php';
@include_once ROOT_DIR . '/util/utilidades.php';

class DataImagenes extends Data implements ImagenesRepository {

    public function __construct() {
        parent::__construct();
    }

    public function getImagenes() {
        return array();
    }

    public function getImagen($idImagen) {
        $query = "select imagen_id,imagen_path,imagen_nombre,imagen_fec_hora,imagen_eliminada,imagen_nombre_archivo, 1 as imagen_orden FROM " . Imagen::$TABLE .
                " WHERE imagen_id= ? ";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $idImagen);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            return $this->createImageObject($row);
        }
        return null;
    }

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $non_query = "insert into " . Imagen::$TABLE . " (imagen_path,imagen_nombre,imagen_nombre_archivo) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('sss', $path, $name, $nombreArchivo)) {
            echo "addImagen - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $name = $imagen->getNombre();
        $nombreArchivo = $imagen->getNombreArchivo();
        $path = $imagen->getPath();

        if (!$stmt->execute()) {
            echo "addImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }

        $stmt->close();
        //conseguimos el idImagen generado
        $imagenId = $this->getUltimoID(Imagen::$TABLE, Imagen::$COLUMN_ID);

        $non_query = "insert into " . ImagenNoticia::$TABLE . " (imagen_id,noticia_id,imagen_orden) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('iii', $imagenId, $noticiaId, $orden)) {
            echo "addImagenNoticia - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $orden = $imagen->getOrden();
        if (!$stmt->execute()) {
            echo "addImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }

        return $imagenId; //returns generated id
    }

    public function getImagenesNoticia($noticiaId) {
        $query = "select i.imagen_id,i.imagen_path,i.imagen_nombre,i.imagen_fec_hora,i.imagen_eliminada,i.imagen_nombre_archivo,ii.imagen_orden FROM " . Imagen::$TABLE . " as i" .
                " INNER JOIN " . ImagenNoticia::$TABLE . " as ii ON ii.imagen_id=i.imagen_id" .
                " WHERE ii.noticia_id= ? and i.imagen_eliminada=0" .
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

    public function editarImagenNoticia(Imagen $imagen) {//TODO: rename to editarImagenNoticia --> orden!
        
        $this->editarImagen($imagen);
        
        $non_query = "update " . ImagenNoticia::$TABLE . " set imagen_orden=? where imagen_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ii', $orden, $imagenId);

        $imagenId = $imagen->getId();
        $orden = $imagen->getOrden();

        if (!$stmt->execute()) {
            echo "editarImagenNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        /* close statement and connection */
        $stmt->close();
    }
    
    
    
    public function editarImagen(Imagen $imagen){
        $non_query = "update " . Imagen::$TABLE . " set imagen_path=?, imagen_nombre=?,imagen_eliminada=?, imagen_nombre_archivo=? where imagen_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssisi', $path, $nombre, $eliminada, $nombreArchivo, $imagenId);

        $eliminada = $imagen->getEliminada();
        $imagenId = $imagen->getId();
        $nombre = $imagen->getNombre();
        $nombreArchivo = $imagen->getNombreArchivo();
        $path = $imagen->getPath();

        if (!$stmt->execute()) {
            echo "editarImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

    }

    public function addImagenReunion(Imagen $imagen, $reunionId) {
//        $non_query = "insert into " . Imagen::$TABLE . " (imagen_path,imagen_nombre,imagen_nombre_archivo,imagen_orden) 
//            values(?,?,?,?)";
//        $stmt = $this->prepareStmt($non_query);
//        if (!$stmt->bind_param('sssii', $path, $name,$nombreArchivo, $orden)) {
//            echo "addImagen - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
//            return -1;
//        }
//        $name = $imagen->getNombre();
//        $nombreArchivo = $imagen->getNombreArchivo();
//        $path = $imagen->getPath();
//        $orden = $imagen->getOrden();
//        if (!$stmt->execute()) {
//            echo "addImagen - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//            return -1;
//        }
//        
//        $non_query = "insert into " . Imagen::$TABLE . " (imagen_path,imagen_nombre,imagen_nombre_archivo,imagen_orden,imagen_noticia_id) 
//            values(?,?,?,?,?)";
//        $stmt = $this->prepareStmt($non_query);
//        if (!$stmt->bind_param('sssii', $path, $name,$nombreArchivo, $orden,$noticiaId)) {
//            echo "addImagen - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
//            return -1;
//        }
//        
//        $stmt->close();
//        $id = $this->getUltimoID(Imagen::$TABLE, Imagen::$COLUMN_ID);
//
//        return $id; //returns generated id
    }

    public function getImagenesReunion($reunionId) {
        
    }

    public function editarImagenReunion(Imagen $imagen) {
        
    }

}

?>
