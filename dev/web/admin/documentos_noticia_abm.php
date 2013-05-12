<?php

include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/controladores/controlador_noticias.php';
include_once ROOT_DIR . '/controladores/controlador_documentos_noticia.php';

$action = $_GET['action'];
$redirectLocation = 'Location: noticias.php';
// the action is not valid
if (!isset($action) || empty($action)) {
    //I dont know what to do!
    header($redirectLocation);
    return;
}

$controladorDocumentos = new ControladorDocumentosNoticia(ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/", $GLOBAL_SETTINGS["news.img.path"]);
if ($action == "add") {// by multipart post.
    $noticiaId = $_GET['id_noticia'];
    if (isset($noticiaId) && !empty($noticiaId)) {
        $controladorDocumentos->setNoticiaId($noticiaId);
        $controladorDocumentos->subeMultiplesDocumentos();
    }
} else if ($action == "del") {
    $idDocumento = $_GET['id_documento'];
    if (isset($idDocumento) && !empty($idDocumento)) {//here we dont care jeje about noticiaId
        $controladorDocumentos->deleteDocumento($idDocumento);
    }
} else {
    //something is really wrong
    header($redirectLocation);
}


?>
