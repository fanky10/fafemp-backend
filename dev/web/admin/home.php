<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/util/utilidades.php';
$manejador = new ManejadorServicios();
$noticias = $manejador->getNoticias($GLOBAL_SETTINGS['news.abm.limit']);
$oNoticia = new Noticia();
$oImagen = new Imagen();
$oDocumento = new Documento();
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
        $navigateTitle = "Panel Administración";
        include_once 'admin_navigate.php';
        ?>

        <div class="content">
            <div class="row">


                <div class="nine columns">
                    <h3>Panel de administración</h3>

                    <div class="row">
                        <div class="twelve columns">
                            <div class="twelve columns">
                                <div class="four columns">
                                    <a class="button radius" title="Noticias" href="noticias.php">Noticias</a>
                                </div>
                                <div class="four columns">
                                    <a class="button radius" title="Reuniones" href="reuniones.php">Reuniones</a>
                                </div>
                                <div class="four columns">
                                    <a class="button radius" title="Documentos" href="documentos.php">Documentos</a>
                                </div>
                                
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <?php include_once 'admin_footer.php'; ?>

    </body>
</html>