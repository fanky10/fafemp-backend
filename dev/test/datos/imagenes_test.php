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

        $imagen = new Imagen();
        $imagen->setNombre("pepe.png");
        $imagen->setPath("/pepe/");

        $idImagen = $this->imagenesRepository->addImagenNoticia($imagen, $idNoticia);
        $this->assertTrue(isset($idImagen));
    }

    private function agregaNoticia() {
        $noticia = new Noticia();
        $noticia->setCuerpo("Noticia con imagen!");
        $noticia->setTitulo("una noticia con imagen");

        return $this->noticiasRepository->addNoticia($noticia);
    }

}

?>
