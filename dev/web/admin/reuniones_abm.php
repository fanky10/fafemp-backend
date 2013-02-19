<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/entidades/reunion.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/controladores/controlador_reuniones.php';
include_once ROOT_DIR . '/controladores/controlador_imagenes.php';
include_once ROOT_DIR . '/controladores/controlador_imagenes_reunion.php';

$action = $_GET['action'];
$redirectLocation = 'Location: reuniones.php';
// the action is not valid
if (!isset($action) || empty($action)) {
    //I dont know what to do!
    header($redirectLocation);
    return;
}
$controladorImagenes = new ControladorImagenesReunion(ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/", $GLOBAL_SETTINGS["news.img.path"]);
$controladorReuniones = new ControladorReuniones($GLOBAL_SETTINGS["reuniones.datepicker.formatter"]);

if ($action == "add") {
    $oReunion = $controladorReuniones->agregarReunion();
    
    $oImagenes = $controladorImagenes->subeMultiplesImagenes();
    $oNoticia->setImagenes($oImagenes);
} else if ($action == "edit") {
    $reunionId = $_GET['id'];
    if (isset($reunionId) && !empty($reunionId)) {
        $controladorImagenes = new ControladorImagenesReunion(ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/", $GLOBAL_SETTINGS["news.img.path"],$reunionId);
        $oReunion = $controladorReuniones->editarReunion($reunionId);
//        $oImagenes = $controladorImagenes->subeMultiplesImagenes($oNoticia->getId());
//        $oNoticia->setImagenes($oImagenes);
    }
} else if ($action == "del") {
    $reunionId = $_GET['id'];
    if (isset($reunionId) && !empty($reunionId)) {
        $controladorReuniones->eliminarReunion($reunionId);
        header($redirectLocation);
        return;
    }
} else {
    header($redirectLocation);
    return;
}
header($redirectLocation);
return;
?>
