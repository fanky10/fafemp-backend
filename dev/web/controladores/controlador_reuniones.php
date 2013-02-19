<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/reunion.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';

class ControladorReuniones {

    protected $manejador;
    private $dateInputPattern;

    public function __construct($dateInputPattern) {
        $this->manejador = new ManejadorServicios();
        $this->dateInputPattern = $dateInputPattern;
    }

    public function agregarReunion() {
        $oReunion = new Reunion();
        $fechaInicio = $this->preparaFecha($_POST['fecha_inicio']);
        $fechaFin = $this->preparaFecha($_POST['fecha_fin']);
        $oReunion->setCuerpo($_POST['cuerpo']);
        $oReunion->setFechaFin($fechaFin);
        $oReunion->setFechaInicio($fechaInicio);
        $oReunion->setTitulo($_POST['titulo']);

        $nuevoId = $this->manejador->addReunion($oReunion);
        $oReunion->setId($nuevoId);
        return $oReunion;
    }

    public function editarReunion($reunionId) {
        $oReunion = new Reunion();
        $oReunion = $this->manejador->getReunionById($reunionId);
        //primero chequeo que quiero editar la reunion correcta
        if (isset($oReunion) && !empty($oReunion)) {
            $fechaInicio = $this->preparaFecha($_POST['fecha_inicio']);
            $fechaFin = $this->preparaFecha($_POST['fecha_fin']);
            $oReunion->setCuerpo($_POST['cuerpo']);
            $oReunion->setFechaFin($fechaFin);
            $oReunion->setFechaInicio($fechaInicio);
            // TODO: handle imagenes
            //$oReunion->setImagenes($imagenes)
            $oReunion->setTitulo($_POST['titulo']);
            $this->manejador->editarReunion($oReunion);
        }
        return $oReunion;
    }
    
    public function eliminarReunion($reunionId){
        $oReunion = new Reunion();
        $oReunion = $this->manejador->getReunionById($reunionId);
        //primero chequeo que quiero editar la reunion correcta
        if (isset($oReunion) && !empty($oReunion)) {
            $oReunion->setEliminada(1);
            $this->manejador->editarReunion($oReunion);
        }
    }

    private function preparaFecha($givenDate) {
        $phpDateTime = DateTime::createFromFormat($this->dateInputPattern, $givenDate);
        $mysqldate = $phpDateTime->format('Y-m-d H:i:s');
        return $mysqldate;
    }

}

?>
