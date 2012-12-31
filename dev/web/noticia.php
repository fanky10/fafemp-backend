
<?php

$idNoticia = $_GET['id'];
if (isset($idNoticia)) {


    include_once '../init.php';
    include_once ROOT_DIR . '/servicios/manejador_servicios.php';
    include_once ROOT_DIR . '/entidades/noticia.php';
    include_once ROOT_DIR . '/entidades/imagen.php';
    $manejador = new ManejadorServicios();
    $oNoticia = $manejador->getNoticiaById($idNoticia);
    $oImagen = new Imagen();
    if (!isset($oNoticia) || empty($oNoticia)) {
        $title = "Próximamente noticias...";
        $link = "#";
        $img = "http://placehold.it/970x290/E9E9E9&text=Próximamente Noticias";
        echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';
    } else {
        $title = $oNoticia->getTitulo();
        $oImagen = $oNoticia->getImagen();
        $link = ROOT_URL ."/noticias/noticias_list.php?id=".$oNoticia->getId();

        $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombre();
        echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';
    }
}
?>
