<?php
include_once 'init.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/reunion.php';
$jsonReunion = new JSONReunion($GLOBAL_SETTINGS['news.abm.limit']);
$jsonReunion->getJSONCalendarReuniones();

class JSONReunion{
    private $manejador;
    private $limitReuniones;
    public function __construct($limitReuniones) {
        $this->manejador = new ManejadorServicios();
        $this->limitReuniones = $limitReuniones;
    }
    
    public function getJSONCalendarReuniones(){
        header("Content-type: application/json");
        $responseMsg = new StdClass;
        $responseMsg->status = "OK";
        $responseMsg->mensaje = "Re daaa";
        $responseMsg->content = $this->getReuniones();
        echo json_encode($responseMsg);
    }
    
    private function getReuniones(){
        $resultIdx = 0;
        $vResult = array();
        $reuniones = $this->manejador->getReuniones($this->limitReuniones);
        $oReunion = new Reunion();
        foreach ($reuniones as $oReunion) {
            $vResult[$resultIdx] = $this->createJsonCalendarObject($oReunion);
            $resultIdx++;
        }
        return $vResult;
    }
    private function createJsonCalendarObject(Reunion $reunion){
        $calendarItem = new StdClass;
        $calendarItem->idReunion = $reunion->getId();
        $calendarItem->titulo = $reunion->getTitulo();
        
        $tstampInicio = time();
        $tstampFin = time();
        $reunionFecInicio = $reunion->getFechaInicio();
        if (isset($reunionFecInicio)) {
            $tstampInicio = strtotime($reunionFecInicio);
            $tstampFin = $tstampFin;
        }
        $reunionFecFin = $reunion->getFechaFin();
        if (isset($reunionFecFin)) {//si esta seteada la sobreescribimos (:
            $tstampFin = strtotime($reunionFecFin);
        }
        $calendarItem->fechaInicio = $tstampInicio;
        $calendarItem->fechaFin = $tstampFin;
        
        return json_encode($calendarItem);
    }
}
?>