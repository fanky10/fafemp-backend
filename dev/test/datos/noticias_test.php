<?php

require_once ('../initTesting.php');
require_once (WEB_ROOT_DIR . '/datos/noticias.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/noticia.php');
require_once ('db_isolated_test_case.php');

class NoticiasTest extends DatabaseIsolatedTestCase {

    private $noticiasRepository;
    
    public function __construct() {
        parent::__construct("Noticias Test");
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
    
    function testGetNoticiaByID(){
        $idNoticia = $this->agregaNoticia();
        $oNoticia = $this->noticiasRepository->getNoticiaById($idNoticia);
        $this->assertTrue(isset($oNoticia));
    }
    
    function testGetNoticiasPaginadas(){
        $i=0;
        while($i<10){//agrego 10 noticias
            $this->agregaNoticia();
            $i++;
        }
        $limit = 3;//news per page
        
        $pag = 1;
        $offset = ($pag - 1) * $limit; //donde empieza a mostrar
        $vNoticias = $this->noticiasRepository->getNoticiasPaginadas($offset, $limit);
        $this->assertTrue(isset($vNoticias) && count($vNoticias)==$limit);
        
        //pagina 2
        $pag = 2;
        $offset = ($pag - 1) * $limit; //donde empieza a mostrar
        $vNoticias = $this->noticiasRepository->getNoticiasPaginadas($offset, $limit);
        $this->assertTrue(isset($vNoticias) && count($vNoticias)==$limit);
        
        //pagina 5
        $pag = 5;
        $offset = ($pag - 1) * $limit; //donde empieza a mostrar
        $vNoticias = $this->noticiasRepository->getNoticiasPaginadas($offset, $limit);
        $this->assertTrue(empty($vNoticias));
    }
    
    function testDeleteNoticia(){
        $idNoticia = $this->agregaNoticia();
        
        $oNoticia = $this->noticiasRepository->getNoticiaById($idNoticia);
        $oNoticia->setEliminada(1);
        $this->noticiasRepository->editarNoticia($oNoticia);
        
        $oNoticia = $this->noticiasRepository->getNoticiaById($idNoticia);
        
        $this->assertTrue($oNoticia->getEliminada()==1);
    }
    function testEditarNoticia(){
        $nuevoTitulo="hola";
        $nuevoCuerpo="chau";
        
        $idNoticia = $this->agregaNoticia();
        
        $oNoticia = $this->noticiasRepository->getNoticiaById($idNoticia);
        $oNoticia->setTitulo($nuevoTitulo);
        $oNoticia->setCuerpo($nuevoCuerpo);
        
        $this->noticiasRepository->editarNoticia($oNoticia);
        
        $oNoticia = $this->noticiasRepository->getNoticiaById($idNoticia);
        
        $this->assertTrue($oNoticia->getTitulo()==$nuevoTitulo && $oNoticia->getCuerpo()==$nuevoCuerpo);
    }
    
    private function agregaNoticia(){
        $noticia = new Noticia();
        $noticia->setCuerpo("Esto es un cuerpo");
        $noticia->setTitulo("re title!");

        return $this->noticiasRepository->addNoticia($noticia);
    }

}

?>
