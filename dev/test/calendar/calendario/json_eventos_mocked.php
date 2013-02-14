<?php
include_once '../mocked/eventos_mocked.php';
date_default_timezone_set('UTC');

        $eventos_mockeados=new EventosMocked();
        $array=$eventos_mockeados->getEventos();
        
	echo json_encode($array);

?>
