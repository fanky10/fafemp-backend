<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/controladores/controlador_noticias.php';

$manejadorNoticias = new ControladorNoticias(ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/", $GLOBAL_SETTINGS["news.img.path"]);
$oNoticia = $manejadorNoticias->subirNoticia();
//TODO: mostrar el set de imagenes (Ni se como... por ahora solo muestro la primera.)
$oImagenes = $oNoticia->getImagenes();
$oImagen = $oImagenes[0];
echo"<!-- DEBUG --";
var_dump($oNoticia);
echo"--> ";
?>
<!DOCTYPE html>

    <!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
    <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
    <!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
        <head>
            <meta charset="utf-8" />

            <!-- Set the viewport width to device width for mobile -->
            <meta name="viewport" content="width=device-width" />

            <title>Foro Argentino de Facultades y Escuelas de Medicina Públicas | Home</title>

            <!-- Included CSS Files (Uncompressed) -->
            <!--
            <link rel="stylesheet" href="stylesheets/foundation.css">
            -->

            <!-- Included CSS Files (Compressed) -->
            <link rel="stylesheet" href="../stylesheets/foundation.css">
            <link rel="stylesheet" href="../stylesheets/app.css">
            <link rel="stylesheet" href="../stylesheets/prettyPhoto.css">
            <link rel="stylesheet" href="../stylesheets/flexslider.css">

            <!-- Author -->
            <link type="text/plain" rel="author" href="humans.txt" />

            <script src="../javascripts/modernizr.foundation.js"></script>

            <!-- Syntax Highlighter -->
            <script src="../javascripts/modernizr.js"></script>
            <!-- Included JS Files (Compressed) -->
            <script src="../javascripts/jquery.js"></script>
            <script src="../javascripts/foundation.min.js"></script>

            <!-- Initialize JS Plugins -->
            <script src="../javascripts/jquery.prettyPhoto.js"></script>
            <script src="../javascripts/jquery_validate.js"></script>
            <script src="../javascripts/app.js"></script>
            <script src="../javascripts/init.js"></script>

            <!-- jQuery -->

            <!-- FlexSlider -->
            <script defer src="../javascripts/jquery.flexslider.js"></script>
            <script defer src="../javascripts/jquery.flexslider-min.js"></script>

            <script type="text/javascript">
                $(function(){
                    SyntaxHighlighter.all();
                });
                $(window).load(function(){
                    $('.flexslider').flexslider({
                        animation: "slide",
                        start: function(slider){
                            $('body').removeClass('loading');
                        }
                    });
                });
            </script>

        </head>
    <body>

        <?php
        include_once 'admin_header.php';
        include_once 'admin_menu.php';
        $navigateTitle = "Noticia - Previsualización";
        include_once 'admin_navigate.php';
        include_once '../common/noticia_content.php';
        include_once 'admin_footer.php';
        ?>

    </body>
</html>