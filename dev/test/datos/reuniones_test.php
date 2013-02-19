<?php

require_once ('../initTesting.php');
require_once (WEB_ROOT_DIR . '/datos/reuniones.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/reunion.php');
require_once ('db_isolated_test_case.php');

class ReunionesTest extends DatabaseIsolatedTestCase {
    
    private $reunionesRepository;
    
    public function __construct() {
        parent::__construct("Reuniones Test");
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
    
    function testDeleteReunion(){
        $idReunion = $this->agregaReunion();
        
        $oReunion = $this->reunionesRepository->getReunionById($idReunion);
        $oReunion->setEliminada(1);
        $this->reunionesRepository->editarReunion($oReunion);
        
        $oReunion = $this->reunionesRepository->getReunionById($idReunion);
        
        $this->assertTrue($oReunion->getEliminada()==1);
    }
    function testEditarNoticia(){
        $nuevoTitulo="hola";
        $nuevoCuerpo="chau";
        
        // pasamos de una fecha php time format (long positive number) a el formato mysql
        $mysqlFormatedFechaFin = date('Y-m-d H:i:s', time() + (2 * 24 * 60 * 60)); // 2 days in the future
        $mysqlFormatedFechaIni = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)); // 7 days in the future
        
        
        $idGenerado = $this->agregaReunion();
        $oReunion = $this->reunionesRepository->getReunionById($idGenerado);
        
        $oReunion->setTitulo($nuevoTitulo);
        $oReunion->setCuerpo($nuevoCuerpo);
        $oReunion->setFechaFin($mysqlFormatedFechaFin);
        $oReunion->setFechaInicio($mysqlFormatedFechaIni);
        
        $this->reunionesRepository->editarReunion($oReunion);
        
        $oReunion = $this->reunionesRepository->getReunionById($idGenerado);
        //assert titulo y cuerpo
        $this->assertTrue($oReunion->getTitulo()==$nuevoTitulo && $oReunion->getCuerpo()==$nuevoCuerpo);
        
        $this->assertTrue($oReunion->getFechaFin()==$mysqlFormatedFechaFin && $oReunion->getFechaInicio()==$mysqlFormatedFechaIni);
    }
    
    private function agregaReunion(){
        $reunion = new Reunion();
        
        $reunion->setCuerpo("Esto es un cuerpo");
        $reunion->setTitulo("re title!");
        
        // esto lo convierte a un mysql directamente.
        // esto es lo mas parecido que va a hacer el controlador.
        // a partir de una fecha ingresada a mano, se formatea a mysql que es mas generico
        $phpDateTime = DateTime::createFromFormat('d/m/Y','25/05/2013');
        $mysqldate = $phpDateTime->format('Y-m-d H:i:s');
        $reunion->setFechaInicio($mysqldate);
        $reunion->setFechaFin($mysqldate);

        return $this->reunionesRepository->addReunion($reunion);
    }

}
?>
