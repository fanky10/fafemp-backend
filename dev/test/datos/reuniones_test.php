<?php

require_once ('../initTesting.php');
require_once (WEB_ROOT_DIR . '/datos/reuniones.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/reunion.php');
require_once ('db_isolated_test_case.php');

class ReunionesTest extends DatabaseIsolatedTestCase {
    
    private $reunionesRepository;
    
    public function __construct() {
        parent::__construct("Imagenes Test");
        $this->reunionesRepository = new DataReuniones();
    }
    
    function testAddReunion() {
        $idReunion = $this->agregaReunion();
        $this->assertTrue(isset($idReunion));
    }
    
    function testGetReunionByID(){
        $idReunion = $this->agregaReunion();
        $oReunion = $this->reunionesRepository->getReunionById($idReunion);
        
        $this->assertTrue(isset($oReunion));
    }
    
    
    
    function testGetReunionesLimited(){
        $i=0;
        while($i<5){
            $this->agregaReunion();
            $i++;
        }
        $limit = 2;
        $vReuniones = $this->reunionesRepository->getReuniones($limit);
        $this->assertTrue(isset($vReuniones) && count($vReuniones)==$limit);
    }
    
    private function agregaReunion(){
        $reunion = new Reunion();
        
        $reunion->setCuerpo("Esto es un cuerpo");
        $reunion->setTitulo("re title!");
        $reunion->setFechaInicio(time());
        $reunion->setFechaFin(time());

        return $this->reunionesRepository->addReunion($reunion);
    }

}
?>
