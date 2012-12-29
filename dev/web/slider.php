<div id="slider">
    <?php
    include_once 'init.php';
    include_once ROOT_DIR . '/servicios/manejador_servicios.php';
    include_once ROOT_DIR . '/entidades/noticia.php';
    include_once ROOT_DIR . '/entidades/imagen.php';
    $manejador = new ManejadorServicios();
    $noticias = $manejador->getNoticias($GLOBAL_SETTINGS['slider.size']);
    $oNoticia = new Noticia();
    $oImagen = new Imagen();
    if (!isset($noticias) || empty ($noticias)) {
        $title = "Próximamente noticias...";
        $link = "#";
        $img = "http://placehold.it/970x290/E9E9E9&text=Próximamente Noticias";
        echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';
    }
    foreach ($noticias as $oNoticia) {

        $title = $oNoticia->getTitulo();
        $oImagen = $oNoticia->getImagen();
        $link = ROOT_URL ."/noticias/noticias_list.php?id=".$oNoticia->getId();
        $img = "http://placehold.it/970x290/E9E9E9&text=".$title;
        //$img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombre();
        echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">Ver más</span></a>';
    }
    ?>
</div>        