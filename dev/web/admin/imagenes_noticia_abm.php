<?php

include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/controladores/controlador_noticias.php';
include_once ROOT_DIR . '/controladores/controlador_imagenes_noticia.php';

$action = $_GET['action'];
$redirectLocation = 'Location: noticias.php';
// the action is not valid
if (!isset($action) || empty($action)) {
    //I dont know what to do!
    header($redirectLocation);
    return;
}
$noticiaId = $_GET['id_noticia'];
$controladorImagenes = new ControladorImagenesNoticia(ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/", $GLOBAL_SETTINGS["news.img.path"],$noticiaId);
if ($action == "add") {// by multipart post.
    if (isset($noticiaId) && !empty($noticiaId)) {
        $controladorImagenes->subeMultiplesImagenes();
    }
} else if ($action == "del") {
    $idImagen = $_GET['id_imagen'];
    if (isset($idImagen) && !empty($idImagen)) {//here we dont care jeje about noticiaId
        $controladorImagenes->deleteImage($idImagen);
    }
} else if ($action == "updateOrder") {
    $controladorImagenes->reorderImagenes();
} else {
    //something is really wrong
    header($redirectLocation);
}



?>
