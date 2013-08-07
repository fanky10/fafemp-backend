<?php

@include_once 'init.php';
@include_once ROOT_DIR . '/mocked/noticias.php';
@include_once ROOT_DIR . '/datos/imagenes.php';
@include_once ROOT_DIR . '/datos/noticias.php';
@include_once ROOT_DIR . '/datos/reuniones.php';
@include_once ROOT_DIR . '/mocked/UserServiceMocked.php';
@include_once ROOT_DIR . '/datos/usuarios.php';
@include_once ROOT_DIR . '/datos/documentos.php';


class ManejadorServicios {

    private $noticiasRepository;
    private $imagenesRepository;
    private $usuariosRepository;
    private $reunionesRepository;
    private $documentosRepository;
    

    public function __construct() {
        
    }

    public function addImagenNoticia(Imagen $imagen, $noticiaId) {
        $this->imagenesRepository = new DataImagenes();
        $idImagen = $this->imagenesRepository->addImagenNoticia($imagen, $noticiaId);
        $imagen->setId($idImagen);
    }
    
     public function addDocumentoNoticia(Documento $documento, $noticiaId) {
    	$this->documentosRepository = new DataDocumentos();
    	$idDocumemto = $this->documentosRepository->addDocumentoNoticia($documento, $noticiaId);
    	$documento->setId($idDocumemto);
    }
    

    public function editarNoticia(Noticia $oNoticia) {
        $this->noticiasRepository = new DataNoticias();
        $this->noticiasRepository->editarNoticia($oNoticia);
    }

    public function addNoticia(Noticia $noticia) {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->addNoticia($noticia);
    }

    public function getNoticiaById($id) {
        $this->noticiasRepository = new DataNoticias();
        $oNoticia = $this->noticiasRepository->getNoticiaById($id);
        $this->asignaImagenesNoticia($oNoticia);
        $this->asignaDocumentosNoticia($oNoticia);
        return $oNoticia;
    }

    public function getNoticiasPaginadas($offset, $limit) {
        $this->noticiasRepository = new DataNoticias();
        $vNoticias = $this->noticiasRepository->getNoticiasPaginadas($offset, $limit);
        $this->asignaImagenesNoticias($vNoticias);
        $this->asignaDocumentosNoticias($vNoticias);
        
        return $vNoticias;
    }

    public function getNoticias($limit) {
        $this->noticiasRepository = new DataNoticias();
        $vNoticias = $this->noticiasRepository->getNoticias($limit);
        $this->asignaImagenesNoticias($vNoticias);
        $this->asignaDocumentosNoticias($vNoticias);
        
        return $vNoticias;
    }

    public function getCantidadNoticias() {
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->getCantidadNoticias();
    }

    public function getUsuarios($user) {
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->getUsuario($user);
    }

    public function cambioPassword($user, $newPassword) {
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->cambioPassword($user, $newPassword);
    }

    public function editarImagenNoticia(Imagen $oImagen) {
        $this->imagenesRepository = new DataImagenes();
        $this->imagenesRepository->editarImagenNoticia($oImagen);
    }
    
     public function editarDocumentoNoticia(Documento $oDocumento) {
    	$this->documentosRepository = new DataDocumentos();
    	$this->documentosRepository->editarDocumentoNoticia($oDocumento);
    }

    public function getImagen($idImagen) {
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->getImagen($idImagen);
    }
    
    public function getDocumento($idDocumento) {
        $this->documentosRepository = new DataDocumentos();
        return $this->documentosRepository->getDocumento($idDocumento);
    }
    
    private function asignaImagenesNoticia($oNoticia) {
        if (!isset($oNoticia)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesNoticia($oNoticia->getId());
        $oNoticia->setImagenes($vImagenes);

        $imagenSlider = $this->imagenesRepository->getImgSliderNoticia($oNoticia->getId());
        $oNoticia->setImagenSlider($imagenSlider);
    }

    private function asignaImagenesNoticias($vNoticias) {
        if (!isset($vNoticias) || empty($vNoticias)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $oNoticia = new Noticia();
        foreach ($vNoticias as $oNoticia) {
            $vImagenes = $this->imagenesRepository->getImagenesNoticia($oNoticia->getId());
            $oNoticia->setImagenes($vImagenes);

            $imagenSlider = $this->imagenesRepository->getImgSliderNoticia($oNoticia->getId());
            $oNoticia->setImagenSlider($imagenSlider);
        }
    }
    
     private function asignaDocumentosNoticia($oNoticia) {
    	if (!isset($oNoticia)) {
            return;
        }
        $this->documentosRepository = new DataDocumentos();
        $vDocumentos = $this->documentosRepository->getDocumentosNoticia($oNoticia->getId());
        $oNoticia->setDocumentos($vDocumentos);
    }
    
    private function asignaDocumentosNoticias($vNoticias) {
    	if (!isset($vNoticias) || empty($vNoticias)) {
    		return;
    	}
    	$this->documentosRepository = new DataDocumentos();
    	$oNoticia = new Noticia();
    	foreach ($vNoticias as $oNoticia) {
    		$vDocumentos = $this->documentosRepository->getDocumentosNoticia($oNoticia->getId());
    		$oNoticia->setDocumentos($vDocumentos);
    	}
    }

    public function getImagenesNoticia($noticiaId) {
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesNoticia($noticiaId);
        return $vImagenes;
    }
    
    public function getDocumentosNoticia($noticiaId) {
        $this->documentosRepository = new DataDocumentos();
        $vDocmentos = $this->documentosRepository->getDocumentosNoticia($noticiaId);
        return $vDocmentos;
    }

    public function getReunionById($reunionId) {
        $this->reunionesRepository = new DataReuniones();
        $oReunion = $this->reunionesRepository->getReunionById($reunionId);
        $this->asignaImagenesReunion($oReunion);
        $this->asignaDocumentosReunion($oReunion);

        return $oReunion;
    }

    public function getReuniones($limit) {
        $this->reunionesRepository = new DataReuniones();
        $vReuniones = $this->reunionesRepository->getReuniones($limit);
        $this->asignaImagenesReuniones($vReuniones);
        $this->asignaDocumentosReuniones($vReuniones);

        return $vReuniones;
    }

    public function addReunion(Reunion $reunion) {
        $this->reunionesRepository = new DataReuniones();
        return $this->reunionesRepository->addReunion($reunion);
    }
    
    public function editarReunion(Reunion $reunion) {
        $this->reunionesRepository = new DataReuniones();
        return $this->reunionesRepository->editarReunion($reunion);
    }
    
    public function eliminarImagen(Imagen $imagen){
        $imagen->setEliminada(1);
        $this->imagenesRepository = new DataImagenes();
        $this->imagenesRepository->editarImagen($imagen);
    }
    
    public function eliminarDocumento(Documento $documento){
        $documento->setEliminada(1);
        $this->documentosRepository = new DataDocumentos();
        $this->documentosRepository->editarDocumento($documento);
    }
    
    public function getImagenesReunion($reunionId){
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->getImagenesReunion($reunionId);
    }
    
    public function getDocumentosReunion($reunionId){
        $this->documentosRepository = new DataDocumentos();
        return $this->documentosRepository->getDocumentosReunion($reunionId);
    }
        
    public function addImagenReunion(Imagen $imagen,$reunionId){
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->addImagenReunion($imagen, $reunionId);
    }
    
    public function addDocumentoReunion(Documento $documento,$reunionId){
        $this->documentosRepository = new DataDocumentos();
        return $this->documentosRepository->addDocumentoReunion($documento, $reunionId);
    }
    
     public function addDocumento(Documento $documento){
        $this->documentosRepository = new DataDocumentos();
        return $this->documentosRepository->addDocumento($documento);
    }
    
    public function editarImagenReunion(Imagen $imagen){
        $this->imagenesRepository = new DataImagenes();
        return $this->imagenesRepository->editarImagenReunion($imagen);
    }
    
    public function editarDocumentoReunion(Documento $documento){
        $this->documentosRepository = new DataDocumentos();
        return $this->documentosRepository->editarDocumentoReunion($documento);
    }

    private function asignaImagenesReunion($oReunion) {
        if (!isset($oReunion)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $vImagenes = $this->imagenesRepository->getImagenesReunion($oReunion->getId());
        $oReunion->setImagenes($vImagenes);
    }
    
    private function asignaDocumentosReunion($oReunion) {
        if (!isset($oReunion)) {
            return;
        }
        $this->documentosRepository = new DataDocumentos();
        $vDocumentos = $this->documentosRepository->getDocumentosReunion($oReunion->getId());
        $oReunion->setDocumentos($vDocumentos);
    }

    private function asignaImagenesReuniones($vReuniones) {
        if (!isset($vReuniones) || empty($vReuniones)) {
            return;
        }
        $this->imagenesRepository = new DataImagenes();
        $oReunion = new Reunion();
        foreach ($vReuniones as $oReunion) {
            $vImagenes = $this->imagenesRepository->getImagenesReunion($oReunion->getId());
            $oReunion->setImagenes($vImagenes);
        }
    }
    
    private function asignaDocumentosReuniones($vReuniones) {
        if (!isset($vReuniones) || empty($vReuniones)) {
            return;
        }
        $this->documentosRepository = new DataDocumentos();
        $oReunion = new Reunion();
        foreach ($vReuniones as $oReunion) {
            $vDocumentos = $this->documentosRepository->getDocumentosReunion($oReunion->getId());
            $oReunion->setDocumentos($vDocumentos);
        }
    }
    
    public function getDocumentos($limit) {
        $this->documentosRepository = new DataDocumentos();
        $vDocumentos = $this->documentosRepository->getDocumentos($limit);
        return $vDocumentos;
    }
    
    public function getDocumentosPaginados($offset, $limit) {
        $this->documentosRepository = new DataDocumentos();
        $vDocumentos = $this->documentosRepository->getDocumentosPaginados($offset, $limit);
        return $vDocumentos;
    }
    
    public function getCantidadDocumentos() {
        $this->documentosRepository = new DataDocumentos();
        return $this->documentosRepository->getCantidadDocumentos();
    }
    
    public function addImagen(Imagen $imagen) {
        return $this->imagenesRepository->addImagen($imagen);
    }

    public function setImgSliderNoticia($noticiaId, $imagenId) {
        $this->imagenesRepository->setImgSliderNoticia($noticiaId, $imagenId);
    }
}

?>