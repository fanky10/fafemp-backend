<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/util/utilidades.php';
$manejador = new ManejadorServicios();
$noticias = $manejador->getNoticias($GLOBAL_SETTINGS['news.abm.limit']);
$oNoticia = new Noticia();
$oImagen = new Imagen();
?>

<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title>Foro Argentino de Facultades y Escuelas de Medicina
            Públicas | ADMIN SITE</title>

        <!-- Included CSS Files (Uncompressed) -->
        <!--
          <link rel="stylesheet" href="stylesheets/foundation.css">
        -->

        <!-- Included CSS Files (Compressed) -->
        <link rel="stylesheet" href="../stylesheets/foundation.css">
        <link rel="stylesheet" href="../stylesheets/app.css">
        <link rel="stylesheet" href="../stylesheets/prettyPhoto.css">

        <!-- Author -->
        <link type="text/plain" rel="author" href="humans.txt" />

        <script src="../javascripts/modernizr.foundation.js"></script>
        <script src="../javascripts/popUpConfirm.js"></script>
    </head>
    <body>
        <?php
        include_once 'admin_header.php';
        include_once 'admin_menu.php';
        $navigateTitle = "Noticias";
        include_once 'admin_navigate.php';
        ?>

        <div class="content">
            <div class="row">
                <div class="twelve columns">
                    <?php
                    if (isset($noticias) && !empty($noticias)) {//hay noticias    
                        ?>
                        <h3>Listado de Noticias</h3>
                        <p>Desde la siguiente lista de noticias podras editar y eliminar noticias ya cargadas.</p>

                        <div class="row">
                            <div class="two columns">
                                <h5>Fecha</h5>
                            </div>
                            <div class="two columns">
                                <h5>Titulo</h5>
                            </div>
                            <div class="four columns">
                                <h5>Descripcion</h5>
                            </div>
                            <div class="two columns">
                            </div>
                            <div class="two columns">
                            </div>
                        </div>
                        <?php
                        foreach ($noticias as $oNoticia) {
                            echo '<div class="row">';
                            echo '<div class="two columns">';
                            $timestamp = time();
                            $noticiaFecHr = $oNoticia->getFechaHora();
                            if (isset($noticiaFecHr)) {
                                $timestamp = strtotime($oNoticia->getFechaHora());
                            }
                            //handle strftime
                            $formattedDate = iconv('ISO-8859-1', 'UTF-8', strftime($GLOBAL_SETTINGS['news.date.formatter'], $timestamp));
                            echo $formattedDate;
                            echo '</div>';


                            echo '<div class="two columns">';
                            echo $oNoticia->getTitulo();

                            echo '</div>';
                            echo '<div class="four columns">';
                            $limiteCuerpo = $GLOBAL_SETTINGS['news.abm.body.limit'];
                            $shortenText = Utilidades::acortaTexto($oNoticia->getCuerpo(), $limiteCuerpo, ".");
                            echo $shortenText;

                            echo '</div>';

                            echo '<div class = "two columns" align = "center">';
                            $linkEdicion = "noticias_edicion.php?id=" . $oNoticia->getId();
                            echo '<a href="' . $linkEdicion . '"><img src="../images/soft-scraps-edit-icon.png" alt="Editar" /></a>';
                            echo '</div>';

                            echo '<div class="two columns" align="center">';
                            $linkEliminar = "noticias_abm.php?action=del&id=" . $oNoticia->getId();
                            echo '<a href="#" onclick="popUpConfirm(\'' . $linkEliminar . '\')"><img src="../images/soft-scraps-delete-icon.png" alt="Eliminar" /></a>';
                            echo '</div>';

                            echo '<div class="twelve columns"> <br/> </div>';
                            
                            echo '</div>';
                        }
                    } else {//no hay noticias
                        echo "<h3>No se han encontrado noticias</h3>";
                    }
                    echo '<a class="button radius" title="Ver más" href="noticias_carga.php">Agregar Noticia</a>';
                    ?>
                </div>
            </div>
        </div>

        <?php include_once 'admin_footer.php'; ?>

    </body>
</html>