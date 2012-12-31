<?php
include_once 'init.php';
$redirect = ROOT_URL.'/noticias.php';
$idNoticia = $_GET['id'];
if (isset($idNoticia)) {
    include_once ROOT_DIR . '/servicios/manejador_servicios.php';
    include_once ROOT_DIR . '/entidades/noticia.php';
    include_once ROOT_DIR . '/entidades/imagen.php';
    $manejador = new ManejadorServicios();
    $oNoticia = $manejador->getNoticiaById($idNoticia);
    $oImagen = new Imagen();
    if (!isset($oNoticia) || empty($oNoticia)) {
        header('Location: '.$redirect);
    } else {
        $title = $oNoticia->getTitulo();
        $oImagen = $oNoticia->getImagen();
        $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombre();
        echo '<img src="' . $img . '" /><span class="slider-caption">' . $title . '</span>';
    }
} else {
    
    header( 'Location: '.$redirect);
}
?>
