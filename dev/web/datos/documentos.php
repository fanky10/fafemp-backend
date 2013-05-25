<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/documentos_repository.php';
@include_once ROOT_DIR . '/entidades/documento.php';
@include_once ROOT_DIR . '/entidades/documento_noticia.php';
@include_once ROOT_DIR . '/entidades/documento_reunion.php';
@include_once ROOT_DIR . '/util/utilidades.php';

class DataDocumentos extends Data implements DocumentosRepository {

    public function __construct() {
        parent::__construct();
    }

    public function getDocumento($idDocumento) {
        $query = "select documento_id,documento_path,documento_nombre,documento_fec_hora,documento_eliminada,documento_nombre_archivo, 1 as documento_orden FROM " . Documento::$TABLE .
                " WHERE documento_id= ? ";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $idDocumento);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            return $this->createDocumentoObject($row);
        }
        return null;
    }

    public function addDocumentoNoticia(Documento $documento, $noticiaId) {
        $this->addDocumento($documento);
        //conseguimos el idDocumento generado
        $documentoId = $this->getUltimoID(Documento::$TABLE, Documento::$COLUMN_ID);

        $non_query = "insert into " . DocumentoNoticia::$TABLE . " (documento_id,noticia_id,documento_orden) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('iii', $documentoId, $noticiaId, $orden)) {
            echo "addDocumentoNoticia - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $orden = $documento->getOrden();
        if (!$stmt->execute()) {
            echo "addDocumento - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }

        return $documentoId; //returns generated id
    }

   
 public function editarDocumentoNoticia(Documento $documento) {
        
        $this->editarDocumento($documento);
        
        $non_query = "update " . DocumentoNoticia::$TABLE . " set documento_orden=? where documento_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ii', $orden, $documentoId);

        $documentoId = $documento->getId();
        $orden = $documento->getOrden();

        if (!$stmt->execute()) {
            echo "editarDocumentoNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        /* close statement and connection */
        $stmt->close();
    }
    
    
    
    public function editarDocumento(Documento $documento){
        $non_query = "update " . Documento::$TABLE . " set documento_path=?, documento_nombre=?,documento_eliminada=?, documento_nombre_archivo=? where documento_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssisi', $path, $nombre, $eliminada, $nombreArchivo, $documentoId);

        $eliminada = $documento->getEliminada();
        $documentoId = $documento->getId();
        $nombre = $documento->getNombre();
        $nombreArchivo = $documento->getNombreArchivo();
        $path = $documento->getPath();

        if (!$stmt->execute()) {
            echo "editarDocumento - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

    }

    public function addDocumentoReunion(Documento $documento, $reunionId) {
        $this->addDocumento($documento);
        //conseguimos el idDocumento generado
        $documentoId = $this->getUltimoID(Documento::$TABLE, Documento::$COLUMN_ID);

        $non_query = "insert into " . DocumentoReunion::$TABLE . " (documento_id,reunion_id,documento_orden) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('iii', $documentoId, $reunionId, $orden)) {
            echo "addDocumentoReunion - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $orden = $documento->getOrden();
        if (!$stmt->execute()) {
            echo "addDocumentoReunion - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }

        return $documentoId; //returns generated id
    }


    public function getDocumentoesReunion($reunionId) {
        $query = "select i.documento_id,i.documento_path,i.documento_nombre,i.documento_fec_hora,i.documento_eliminada,i.documento_nombre_archivo,ii.documento_orden FROM " . Documento::$TABLE . " as i" .
                " INNER JOIN " . DocumentoReunion::$TABLE . " as ii ON ii.documento_id=i.documento_id" .
                " WHERE ii.reunion_id= ? and i.documento_eliminada=0" .
                " ORDER BY documento_orden";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $reunionId);

        $stmt->execute();

        $result = $stmt->get_result();


        $doc_idx = 0;
        $vDocumentos = array();
        while ($row = $result->fetch_assoc()) {
            $oDocumento = $this->createDocumentoObject($row);
            $vDocumentos[$doc_idx] = $oDocumento;
            $doc_idx++;
        }
        return $vDocumentos;
    }

    public function editarDocumentoReunion(Documento $documento) {
        
        $this->editarDocumento($documento);
        
        $non_query = "update " . DocumentoReunion::$TABLE . " set documento_orden=? where documento_id=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ii', $orden, $documentoId);

        $documentoId = $documento->getId();
        $orden = $documento->getOrden();

        if (!$stmt->execute()) {
            echo "editarDocumentoNoticia - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        /* close statement and connection */
        $stmt->close();
    }
    
    public function addDocumento(Documento $documento){
        $non_query = "insert into " . Documento::$TABLE . " (documento_path,documento_nombre,documento_nombre_archivo) 
            values(?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        if (!$stmt->bind_param('sss', $path, $name, $nombreArchivo)) {
            echo "addDocumento - Bind Param failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }
        $name = $documento->getNombre();
        $nombreArchivo = $documento->getNombreArchivo();
        $path = $documento->getPath();

        if (!$stmt->execute()) {
            echo "addDocumento - Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return -1;
        }

        $stmt->close();
    }

    public function getDocumentosNoticia($noticiaId) {
         $query = "select i.documento_id,i.documento_path,i.documento_nombre,i.documento_fec_hora,i.documento_eliminada,i.documento_nombre_archivo,ii.documento_orden FROM " . Documento::$TABLE . " as i" .
                " INNER JOIN " . DocumentoNoticia::$TABLE . " as ii ON ii.documento_id=i.documento_id" .
                " WHERE ii.noticia_id= ? and i.documento_eliminada=0" .
                " ORDER BY documento_orden";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $noticiaId);

        $stmt->execute();

        $result = $stmt->get_result();


        $doc_idx = 0;
        $vDocumentos = array();
        while ($row = $result->fetch_assoc()) {
            $oDocumento = $this->createDocumentoObject($row);
            $vDocumentos[$doc_idx] = $oDocumento;
            $doc_idx++;
        }
        return $vDocumentos;
        
    }
    
    private function createDocumentoObject($row) {
        $oDocumento = new Documento();
        $id = $row['documento_id'];
        $docPath = $row['documento_path'];
        $docNombre = $row['documento_nombre'];
        $docNombreArchivo = $row['documento_nombre_archivo'];
        $docFecHora = $row['documento_fec_hora'];
        $docEliminada = $row['documento_eliminada'];
        $docOrden = $row['documento_orden'];
        $oDocumento->setId($id);
        $oDocumento->setNombre($docNombre);
        $oDocumento->setPath($docPath);
        $oDocumento->setNombreArchivo($docNombreArchivo);
        $oDocumento->setEliminada($docEliminada);
        $oDocumento->setFechaHora($docFecHora);
        $oDocumento->setOrden($docOrden);
        return $oDocumento;
    }

    public function getDocumentosReunion($reunionId) {
        $query = "select i.documento_id,i.documento_path,i.documento_nombre,i.documento_fec_hora,i.documento_eliminada,i.documento_nombre_archivo,ii.documento_orden FROM " . Documento::$TABLE . " as i" .
                " INNER JOIN " . DocumentoReunion::$TABLE . " as ii ON ii.documento_id=i.documento_id" .
                " WHERE ii.documento_id= ? and i.documento_eliminada=0" .
                " ORDER BY documento_orden";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $reunionId);

        $stmt->execute();

        $result = $stmt->get_result();


        $doc_idx = 0;
        $vDocumentos = array();
        while ($row = $result->fetch_assoc()) {
            $oDocumento = $this->createDocumentoObject($row);
            $vDocumentos[$doc_idx] = $oDocumento;
            $doc_idx++;
        }
        return $vDocumentos;
    }

    
    public function getDocumentos($limit) {
        $query = "select d.documento_id,d.documento_nombre,d.documento_path,d.documento_nombre_archivo,d.documento_eliminada,d.documento_fec_hora
            from documentos d WHERE d.documento_eliminada=0
            ORDER BY d.documento_fec_hora desc limit ?";
        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('i', $limit);

        $stmt->execute();

        $result = $stmt->get_result();

        $documento_idx = 0;
        $vDocs = array();
        while ($row = $result->fetch_assoc()) {

            $oDocumento = $this->generaDocumento($row);

            $vDocs[$documento_idx] = $oDocumento;
            $documento_idx = $documento_idx + 1;
        }
        $stmt->close();
        return $vDocs;
    }
    
     private function generaDocumento($row) {
        $id = $row['documento_id'];
        $nombre = $row['documento_nombre'];
        $path = $row['documento_path'];
        $eliminada = $row['documento_eliminada'];
        $nombreArchivo = $row['documento_nombre_archivo'];
        $fechaHora = $row['documento_fec_hora'];

        
        $oDocumento = new Documento();
        $oDocumento->setId($id);
        $oDocumento->setNombre($nombre);
        $oDocumento->setPath($path);
        $oDocumento->setNombreArchivo($nombreArchivo);
        $oDocumento->setEliminada($eliminada);
        $oDocumento->setFechaHora($fechaHora);
        return $oDocumento;
    }

}

?>
