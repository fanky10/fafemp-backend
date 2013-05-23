<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/documento.php';

interface DocumentosRepository{
    public function getDocumento($id);
    
    public function editarDocumento(Documento $documento);
    
    public function editarDocumentoNoticia(Documento $documento);
    public function getDocumentosNoticia($noticiaId);
    public function addDocumentoNoticia(Documento $documento,$noticiaId);
    
    public function getDocumentosReunion($reunionId);
    public function addDocumentoReunion(Documento $documento,$reunionId);
    public function editarDocumentoReunion(Documento $documento);
    
    public function getDocumentos($limit);
}
?>
