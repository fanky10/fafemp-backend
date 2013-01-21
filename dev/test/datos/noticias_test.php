<?php

require_once ('../initTesting.php');
require_once (TEST_ROOT_DIR . '/simpletest/autorun.php');
require_once (WEB_ROOT_DIR . '/datos/noticias.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/noticia.php');

class NoticiasTest extends UnitTestCase {

    private $noticiasRepository;
    private $dataSource;
    public function __construct() {
        parent::__construct("Imagenes Test");
        $this->noticiasRepository = new DataNoticias();
        $this->dataSource = MysqlDataSource::getInstance();
    }
    function setUp() {
        $this->dataSource->startTransaction();
    }
    //isolate each test (:
    function tearDown() {
        $this->dataSource->rollbackTransaction();
        $this->dataSource->closeConnection();
    }

    function testAddNoticia() {
        $idNoticia = $this->agregaNoticia();
        $this->assertTrue(isset($idNoticia));
        
    }
    
    function testGetNoticiasSlider(){
        $i=0;
        while($i<5){
            $this->agregaNoticia();
            $i++;
        }
        $limit = 2;
        $vNoticias = $this->noticiasRepository->getNoticias($limit);
        $this->assertTrue(isset($vNoticias) && count($vNoticias)==$limit);
    }
    
    function agregaNoticia(){
        $noticia = new Noticia();
        $noticia->setCuerpo("Esto es un cuerpo");
        $noticia->setTitulo("re title!");

        return $this->noticiasRepository->addNoticia($noticia);
    }

}

?>
