<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once 'controlador_documentos.php';

class ControladorDocumentosNoticia extends ControladorDocumentos {

    private $noticiaId;

    public function __construct($dirBase, $docPath) {
        parent::__construct($dirBase, $docPath);
    }

    protected function getDocumentosGuardados() {
        return $this->manejador->getDocumentosNoticia($this->noticiaId);
    }

    protected function saveDocumento($safe_name, $safe_filename, $orden) {
        $oDocumento = new Documento();
        $oDocumento->setNombre($safe_name);
        $oDocumento->setNombreArchivo($safe_filename);
        $oDocumento->setPath($this->docPath);
        $oDocumento->setOrden($orden);
        $this->manejador->addDocumentoNoticia($oDocumento, $this->noticiaId);
        return $oDocumento;
    }

    

    public function setNoticiaId($noticiaId) {
        $this->noticiaId = $noticiaId;
    }

}

?>