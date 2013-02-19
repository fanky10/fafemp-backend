<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/util/utilidades.php';
$manejador = new ManejadorServicios();
$reuniones = $manejador->getReuniones($GLOBAL_SETTINGS['news.abm.limit']);
$oReunion = new Reunion();
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
        $navigateTitle = "Reuniones";
        include_once 'admin_navigate.php';
        ?>

        <div class="content">
            <div class="row">
                <div class="twelve columns">
                    <?php
                    if (isset($reuniones) && !empty($reuniones)) {//hay reuniones    
                        ?>
                        <h3>Listado de Reuniones</h3>
                        <p>Desde la siguiente lista de noticias podras editar y eliminar reuniones ya cargadas.</p>

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
                        foreach ($reuniones as $oReunion) {
                            echo '<div class="row">';
                            echo '<div class="two columns">';
                            $timestamp = time();
                            $reunionFecHr = $oReunion->getFechaInicio();
                            if (isset($reunionFecHr)) {
                                $timestamp = strtotime($reunionFecHr);
                            }
                            //handle strftime
                            $formattedDate = strftime($GLOBAL_SETTINGS['news.date.formatter'], $timestamp);
                            echo $formattedDate;
                            echo '</div>';


                            echo '<div class="two columns">';
                            echo $oReunion->getTitulo();

                            echo '</div>';
                            echo '<div class="four columns">';
                            $limiteCuerpo = $GLOBAL_SETTINGS['news.abm.body.limit'];
                            $shortenText = Utilidades::acortaTexto($oReunion->getCuerpo(), $limiteCuerpo, ".");
                            echo $shortenText;

                            echo '</div>';

                            echo '<div class = "two columns" align = "center">';
                            $linkEdicion = "reuniones_edicion.php?id=" . $oReunion->getId();
                            echo '<a href="' . $linkEdicion . '"><img src="../images/soft-scraps-edit-icon.png" alt="Editar" /></a>';
                            echo '</div>';

                            echo '<div class="two columns" align="center">';
                            $linkEliminar = "reuniones_abm.php?action=del&id=" . $oReunion->getId();
                            echo '<a href="#" onclick="popUpConfirm(\'' . $linkEliminar . '\',\'Seguro desea eliminar la reunion?\')"><img src="../images/soft-scraps-delete-icon.png" alt="Eliminar" /></a>';
                            echo '</div>';

                            echo '<div class="twelve columns"> <br/> </div>';
                            
                            echo '</div>';
                        }
                    } else {//no hay noticias
                        echo "<h3>No se han encontrado reuniones</h3>";
                    }
                    echo '<a class="button radius" title="Ver más" href="reuniones_carga.php">Agregar Reunion</a>';
                    ?>
                </div>
            </div>
        </div>

        <?php include_once 'admin_footer.php'; ?>

    </body>
</html>