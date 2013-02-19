<?php

require_once ('../initTesting.php');
require_once (WEB_ROOT_DIR . '/datos/imagenes.php');
require_once (WEB_ROOT_DIR . '/datos/noticias.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/imagen.php');
require_once (WEB_ROOT_DIR . '/entidades/noticia.php');
require_once ('db_isolated_test_case.php');

class ImagenesTest extends DatabaseIsolatedTestCase {

    private $imagenesRepository;
    private $noticiasRepository;

    public function __construct() {
        parent::__construct("Imagenes Test");
        $this->imagenesRepository = new DataImagenes();
        $this->noticiasRepository = new DataNoticias();
    }

    function testAddImage() {
        $idNoticia = $this->agregaNoticia();
        $idImagen = $this->agregaImagen($idNoticia);
        $this->assertTrue(isset($idImagen));
    }

    function testGetImagenesNoticia() {
        $idNoticia = $this->agregaNoticia();
        $i = 0;
        while ($i < 4) {
            $this->agregaImagen($idNoticia);
            $i++;
        }
        $imagenes = $this->imagenesRepository->getImagenesNoticia($idNoticia);
        $this->assertTrue(isset($imagenes) && count($imagenes) == 4);
    }

    function testGetImagenByID() {
        $idNoticia = $this->agregaNoticia();
        $idImagen = $this->agregaImagen($idNoticia);
        
        $oImagen = $this->imagenesRepository->getImagen($idImagen);
        $this->assertTrue(isset($oImagen));
    }

    function testEditImagen() {
        $idNoticia = $this->agregaNoticia();
        $idImagen = $this->agregaImagen($idNoticia);

        $imagen = new Imagen();
        $editedImagen = new Imagen();

        $imagen->setNombre("pepe2.png");
        $imagen->setNombreArchivo("pepe2.png");
        $imagen->setPath("/pepe/2");
        $imagen->setOrden(5);
        $imagen->setId($idImagen);

        $this->imagenesRepository->editarImagen($imagen);

        $editedImagen = $this->imagenesRepository->getImagen($idImagen);
        $this->assertTrue(isset($editedImagen) && $this->isEquals($imagen, $editedImagen));
    }

    private function agregaImagen($idNoticia) {
        $imagen = new Imagen();
        $imagen->setNombre("pepe.png");
        $imagen->setNombreArchivo("pepe.png");
        $imagen->setPath("/pepe/");
        $imagen->setOrden(1);

        return $this->imagenesRepository->addImagenNoticia($imagen, $idNoticia);
    }

    private function agregaNoticia() {
        $noticia = new Noticia();
        $noticia->setCuerpo("Noticia con imagen!");
        $noticia->setTitulo("una noticia con imagen");

        return $this->noticiasRepository->addNoticia($noticia);
    }

    private function isEquals(Imagen $imagen, Imagen $otherImagen) {
        return ($imagen->getNombre() == $otherImagen->getNombre() &&
                $imagen->getNombreArchivo() == $otherImagen->getNombreArchivo() &&
                $imagen->getPath() == $otherImagen->getPath() &&
                $imagen->getOrden() == $otherImagen->getOrden() );
    }

}

?>
