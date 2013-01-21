<?php

require_once ('../initTesting.php');
require_once (TEST_ROOT_DIR . '/simpletest/autorun.php');
require_once (WEB_ROOT_DIR . '/datos/imagenes.php');
require_once (WEB_ROOT_DIR . '/datos/noticias.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/imagen.php');
require_once (WEB_ROOT_DIR . '/entidades/noticia.php');

class ImagenesTest extends UnitTestCase {

    private $imagenesRepository;
    private $noticiasRepository;
    private $dataSource;
    public function __construct() {
        parent::__construct("Imagenes Test");
        $this->imagenesRepository = new DataImagenes();
        $this->noticiasRepository = new DataNoticias();
        $this->dataSource = MysqlDataSource::getInstance();
        
    }
    
    //isolate each test (:
    function setUp() {
        $this->dataSource->startTransaction();
    }
    
    function tearDown() {
        $this->dataSource->rollbackTransaction();
        $this->dataSource->closeConnection();
    }

    function testAddImage() {
        $idNoticia = $this->agregaNoticia();
        
        $imagen = new Imagen();
        $imagen->setNombre("pepe.png");
        $imagen->setPath("/pepe/");

        $idImagen = $this->imagenesRepository->addImagenNoticia($imagen, $idNoticia);
        $this->assertTrue(isset($idImagen));
        
    }
    private function agregaNoticia(){
        $noticia = new Noticia();
        $noticia->setCuerpo("Noticia con imagen!");
        $noticia->setTitulo("una noticia con imagen");

        return $this->noticiasRepository->addNoticia($noticia);
    }

}

?>
