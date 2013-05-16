<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/reunion.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once 'controlador_documentos.php';

class ControladorDocumentosReunion extends ControladorDocumentos {

    private $reunionId;

    public function __construct($dirBase, $docPath) {
        parent::__construct($dirBase, $docPath);
    }

    protected function getDocumentosGuardados() {
        return $this->manejador->getDocumentosReunion($this->reunionId);
    }

    protected function saveDocumento($safe_name, $safe_filename, $orden) {
        $oDocumento = new Documento();
        $oDocumento->setNombre($safe_name);
        $oDocumento->setNombreArchivo($safe_filename);
        $oDocumento->setPath($this->docPath);
        $oDocumento->setOrden($orden);
        $this->manejador->addDocumentoReunion($oDocumento, $this->reunionId);
        return $oDocumento;
    }

    

    public function setReunionId($reunionId) {
        $this->reunionId = $reunionId;
    }

}

?>