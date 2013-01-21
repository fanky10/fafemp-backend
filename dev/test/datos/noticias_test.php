<?php

require_once ('../initTesting.php');
require_once (WEB_ROOT_DIR . '/datos/noticias.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/noticia.php');
require_once ('db_isolated_test_case.php');

class NoticiasTest extends DatabaseIsolatedTestCase {

    private $noticiasRepository;
    
    public function __construct() {
        parent::__construct("Imagenes Test");
        $this->noticiasRepository = new DataNoticias();
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
    
    private function agregaNoticia(){
        $noticia = new Noticia();
        $noticia->setCuerpo("Esto es un cuerpo");
        $noticia->setTitulo("re title!");

        return $this->noticiasRepository->addNoticia($noticia);
    }

}

?>
