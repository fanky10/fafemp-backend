<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once 'controlador_documentos.php';

class ControladorDocumentosComun extends ControladorDocumentos {
    private $limit;
    public function __construct($dirBase, $docPath,$limit) {
        parent::__construct($dirBase, $docPath);
        $this->limit = $limit;
    }


    protected function saveDocumento($safe_name, $safe_filename, $orden) {
        $oDocumento = new Documento();
        $oDocumento->setNombre($safe_name);
        $oDocumento->setNombreArchivo($safe_filename);
        $oDocumento->setPath($this->docPath);
        $oDocumento->setOrden($orden);
        $this->manejador->addDocumento($oDocumento);
        return $oDocumento;
    }

    protected function getDocumentosGuardados() {
        $this->manejador->getDocumentos($this->limit);
        
    }


}

?>