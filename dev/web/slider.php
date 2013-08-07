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
    $title = "Salud Pública";
    $link = "#";
    $img = "images/slider3.jpg";
    echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';

    $title = "Exámen Unificado de Residencias y Posgrado";
    $link = "#";
    $img = "images/slider2.jpg";
    echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';
    
    $title = "Reuniones Plenarias del Foro";
    $link = "#";
    $img = "images/slider5.jpg";
    echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';

    $title = null;
    $link = "#";
    $img = "images/slider1.jpg";
    echo '<a href="' . $link . '"><img src="' . $img . '" /></a>';

    $title = "Prácticas Quirúrgicas";
    $link = "#";
    $img = "images/slider4.jpg";
    echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">' . $title . '</span></a>';
    foreach ($noticias as $oNoticia) {

        $title = $oNoticia->getTitulo();
        $oImagen = $oNoticia->getImagen();
        $link = ROOT_URL ."/noticia.php?id=".$oNoticia->getId();
        $img = "http://placehold.it/970x290/E9E9E9&text=".$title;
        $captionMsg = 'Ver más';
        $oImgSlider = $oNoticia->getImagenSlider();
        if(isset($oImgSlider)){
            $img = ROOT_URL . "/" . $oImgSlider->getPath() . "/" . $oImgSlider->getNombreArchivo();
            $captionMsg = $title;
        }
        echo '<a href="' . $link . '"><img src="' . $img . '" /><span class="slider-caption">'.$captionMsg.'</span></a>';
    }
    ?>
</div>        
