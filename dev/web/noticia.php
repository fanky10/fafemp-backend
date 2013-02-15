
<?php
include_once 'init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';

$redirect = ROOT_URL . '/noticias.php';
$idNoticia = $_GET['id'];
$isRedirect = true;
$oNoticia = new Noticia();
//$oImagen = new Imagen();
if (isset($idNoticia)) {
    $manejador = new ManejadorServicios();
    $oNoticia = $manejador->getNoticiaById($idNoticia);
    $vImagenes = $oNoticia->getImagenes();
    if (isset($vImagenes) && !empty($vImagenes)) {
        $oImagen = $vImagenes[0];
    }
    if (!isset($oNoticia) || empty($oNoticia)) {
        $isRedirect = true;
    } else {
        $isRedirect = false;
    }
} else {
    $isRedirect = true;
}
if ($isRedirect) {
    header('Location: ' . $redirect);
} else {
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
            <link rel="stylesheet" href="stylesheets/foundation.css">
            <link rel="stylesheet" href="stylesheets/app.css">
            <link rel="stylesheet" href="stylesheets/prettyPhoto.css">
            <link rel="stylesheet" href="stylesheets/flexslider.css">

            <!-- Author -->
            <link type="text/plain" rel="author" href="humans.txt" />

            <script src="javascripts/modernizr.foundation.js"></script>

            <!-- Syntax Highlighter -->
            <script src="javascripts/modernizr.js"></script>
            <!-- Included JS Files (Compressed) -->
            <script src="javascripts/jquery.js"></script>
            <script src="javascripts/foundation.min.js"></script>

            <!-- Initialize JS Plugins -->
            <script src="javascripts/jquery.prettyPhoto.js"></script>
            <script src="javascripts/jquery_validate.js"></script>
            <script src="javascripts/app.js"></script>
            <script src="javascripts/init.js"></script>

            <!-- jQuery -->

            <!-- FlexSlider -->
            <script defer src="javascripts/jquery.flexslider.js"></script>
            <script defer src="javascripts/jquery.flexslider-min.js"></script>

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

            <!-- Header and Nav -->
            <?php include_once 'header.php'; ?>

            <!-- End Header and Nav -->
            <?php
            $seccion = "noticias";
            include_once 'menu_header.php';
            $navigateTitle = "Noticia";
            include_once 'navigate.php'
            ?>

            <?php include_once 'common/noticia_content.php'; ?>

            <!-- Footer -->
            <?php include_once 'footer.php'; ?> 
        </body>
    </html>

<?php } ?>