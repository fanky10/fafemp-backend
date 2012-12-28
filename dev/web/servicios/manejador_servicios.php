<?php
@include_once 'init.php';
@include_once ROOT_DIR .'/mocked/noticias.php';
@include_once ROOT_DIR .'/datos/imagenes.php';
@include_once ROOT_DIR .'/datos/noticias.php';


class ManejadorServicios{
    private $noticiasRepository;
    private $imagenesRepository;
    public function __construct() {
        
    }
    
    public function getNoticias(){
        $this->noticiasRepository = new MockedNoticias();
        return $this->noticiasRepository->getNoticias();
    }
    public function addNoticia(Noticia $noticia){
        $imagen = new Imagen();
        $imagen = $noticia->getImagen();
        $this->imagenesRepository = new DataImagenes();
        $idImagen = $this->imagenesRepository->addImagen($imagen);
        $imagen->setId($idImagen);
        $this->noticiasRepository = new DataNoticias();
        return $this->noticiasRepository->addNoticia($noticia);
    }
}
?>
