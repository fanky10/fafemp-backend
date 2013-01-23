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

    private function agregaImagen($idNoticia) {
        $imagen = new Imagen();
        $imagen->setNombre("pepe.png");
        $imagen->setPath("/pepe/");

        return $this->imagenesRepository->addImagenNoticia($imagen, $idNoticia);
    }

    private function agregaNoticia() {
        $noticia = new Noticia();
        $noticia->setCuerpo("Noticia con imagen!");
        $noticia->setTitulo("una noticia con imagen");

        return $this->noticiasRepository->addNoticia($noticia);
    }

}

?>
