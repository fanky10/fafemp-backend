<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/entidades/reunion.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/controladores/controlador_reuniones.php';
include_once ROOT_DIR . '/controladores/controlador_imagenes.php';

$action = $_GET['action'];
$redirectLocation = 'Location: reuniones.php';
// the action is not valid
if (!isset($action) || empty($action)) {
    //I dont know what to do!
    header($redirectLocation);
    return;
}

$controladorReuniones = new ControladorReuniones($GLOBAL_SETTINGS["reuniones.datepicker.formatter"]);
$controladorImagenes = new ControladorImagenes(ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/", $GLOBAL_SETTINGS["news.img.path"]);
if ($action == "add") {
    $oReunion = $controladorReuniones->agregarReunion();
//    $oImagenes = $controladorImagenes->subeMultiplesImagenes($oNoticia->getId());
//    $oNoticia->setImagenes($oImagenes);
} else if ($action == "edit") {
    $reunionId = $_GET['id'];
    if (isset($reunionId) && !empty($reunionId)) {
        $oReunion = $controladorReuniones->editarReunion($reunionId);
//        $oImagenes = $controladorImagenes->subeMultiplesImagenes($oNoticia->getId());
//        $oNoticia->setImagenes($oImagenes);
    }
} else if ($action == "del") {
    $noticiaId = $_GET['id'];
    if (isset($noticiaId) && !empty($noticiaId)) {
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
