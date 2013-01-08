<?php
include_once 'init.php';
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
    $oImagen = $oNoticia->getImagen();
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

            <!-- Author -->
            <link type="text/plain" rel="author" href="humans.txt" />

            <script src="javascripts/modernizr.foundation.js"></script>
        </head>
        <body>

            <!-- Header and Nav -->
            <div class="logo">
                <div class="row">
                    <div class="one columns isotipo">
                        <a href="index.html" title="Foro Argentino de Facultades y Escuelas de Medicina Públicas"><img src="images/logo-foro-argentino-de-facultades-y-escuelas-de-medicina-publicas.png" /></a></div>
                    <div class="eight columns">
                        <h2 class="slogan">Contribuyendo a formar los profesionales de la salud que el país necesita</h2>
                        <h1 class="logotipo">Foro Argentino de Facultades y Escuelas de Medicina Públicas</h1>
                    </div>
                    <div class="three columns">
                        <ul class="social-box link-list right">
                            <li><a href="#" class="facebook">Facebook</a></li>
                            <li><a href="#" class="twitter">Twitter</a></li>
                            <li><a href="#" class="linkedin">LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- End Header and Nav -->
            <?php include_once 'menu_header.php'; ?>
            <!-- First Band (Slider) -->
            <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
            <div class="breadcrums">
                <div class="row">
                    <div class="twelve columns">
                        <ul class="inline-list">
                            <li><a href="index.html">Home</a></li>
                            <li>></li>
                            <li>Noticias</li>
                        </ul>        
                    </div>
                </div>
            </div>
            <!-- Three-up Content Blocks -->
            <div class="content">
                <div class="row">
                    <div class="twelve columns">
                        <hr class="sin-margin-top" />
                    </div>
                    <div class="twelve columns">
                        <p class="destacado" style="text-transform: uppercase;">
                            <?php
                            $timestamp = strtotime($oNoticia->getFechaHora());
                            $formattedDate = strftime($GLOBAL_SETTINGS['news.date.formatter'],$timestamp);
                            echo $formattedDate;
                            ?>
                        </p>
                        <h3 class="destacado" style="text-transform: capitalize;">
                            <?php
                            echo $oNoticia->getTitulo();
                            ?>
                        </h3>

                    </div>
                    <div class="six columns">
                        <?php
                        $imgWidth = $GLOBAL_SETTINGS['news.img.preview.width'];
                        $imgHeight = $GLOBAL_SETTINGS['news.img.preview.height'];
                        if (isset($oImagen)) {
                            $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombre();
                        } else {

                            $img = "http://placehold.it/" . $imgWidth . "x" . $imgHeight . "/E9E9E9&text=Sin imagen";
                        }
                        echo '<img src="' . $img . '" />';
                        ?>
                    </div>
                    <div class="six columns">
                        <p class="text-justify"><?php echo $oNoticia->getCuerpo(); ?></p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include_once 'footer.php'; ?> 

            <!-- Included JS Files (Compressed) -->
            <script src="javascripts/jquery.js"></script>
            <script src="javascripts/foundation.min.js"></script>

            <!-- Initialize JS Plugins -->
            <script src="javascripts/jquery.prettyPhoto.js"></script>
            <script src="javascripts/jquery_validate.js"></script>
            <script src="javascripts/app.js"></script>
            <script src="javascripts/init.js"></script>

        </body>
    </html>

<?php } ?>

