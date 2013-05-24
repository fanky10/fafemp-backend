<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/entidades/documento.php';
$manejador = new ManejadorServicios();
$documentos = $manejador->getDocumentos($GLOBAL_SETTINGS['news.abm.limit']);
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
        $navigateTitle = "Documentos";
        include_once 'admin_navigate.php';
        ?>

        <div class="content">
            <div class="row">
                <div class="twelve columns">
                    <?php
                    if (isset($documentos) && !empty($documentos)) {//hay reuniones    
                        ?>
                        <h3>Listado de Documentos</h3>
                        <p>Desde la siguiente lista de documentos podras descargar y eliminar documentos ya cargados.</p>

                        <div class="row">
                            <div class="six columns">
                                <h5>Nombre</h5>
                            </div>
                            <div class="four columns">
                                <h5>Link para descarga</h5>
                            </div>
                            <div class="two columns">
                                <h5>Link para eliminar documento</h5>
                            </div>
                        </div>
                        <?php
                        foreach ($documentos as $oDocumento) {
                            echo '<div class="row">';
                            echo '<div class="six columns">';
                            echo $oDocumento->getNombreArchivo();
                            echo '</div>';
                           
                            echo '<div class = "four columns" align = "center">';
                            $linkDownload = $oDocumento->getPath();
                            echo '<a href="' . $linkDownload . '"><img src="../images/soft-scraps-edit-icon.png" alt="Editar" /></a>';
                            echo '</div>';

                            echo '<div class="two columns" align="center">';
                            $linkEliminar = "documentos_abm.php?action=del&id=" . $oDocumento->getId();
                            echo '<a href="#" onclick="popUpConfirm(\'' . $linkEliminar . '\',\'Seguro desea eliminar el documento?\')"><img src="../images/soft-scraps-delete-icon.png" alt="Eliminar" /></a>';
                            echo '</div>';

                            echo '<div class="twelve columns"> <br/> </div>';
                            
                            echo '</div>';
                        }
                    } else {//no hay noticias
                        echo "<h3>No se han encontrado documentos</h3>";
                    }
                    echo '<a class="button radius" title="Ver más" href="documentos_carga.php">Agregar Documento</a>';
                    ?>
                </div>
            </div>
        </div>

        <?php include_once 'admin_footer.php'; ?>

    </body>
</html>