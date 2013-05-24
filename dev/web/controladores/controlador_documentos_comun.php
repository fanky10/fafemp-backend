<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once 'controlador_documentos.php';

class ControladorDocumentosComun extends ControladorDocumentos {

    public function __construct($dirBase, $docPath) {
        parent::__construct($dirBase, $docPath);
    }


    protected function saveDocumento($safe_name, $safe_filename, $orden) {
        $oDocumento = new Documento();
        $oDocumento->setNombre($safe_name);
        $oDocumento->setNombreArchivo($safe_filename);
        $oDocumento->setPath($this->docPath);
        $oDocumento->setOrden($orden);
        return $oDocumento;
    }

    protected function getDocumentosGuardados() {
        
    }


}

?>