<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR .'/entidades/noticia.php';
include_once ROOT_DIR .'/entidades/imagen.php';
include_once ROOT_DIR .'/servicios/manejador_servicios.php';
include_once ROOT_DIR .'/util/utilidades.php';

$manejador = new ManejadorServicios();
// validation
//  5MB maximum file size
// TODO: settings max file
$MAXIMUM_FILESIZE = 5 * 1024 * 1024;
//  Valid file extensions (images, word, excel, powerpoint)
$rEFileTypes =
        "/^\.(jpg|jpeg|gif|png|doc|docx|txt|rtf|pdf|xls|xlsx|
        ppt|pptx){1}$/i";
$dirBase = ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/";

$isFile = is_uploaded_file($_FILES["file"]["tmp_name"]);
$everythingFine = false;
if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else if ($isFile) {    //  do we have a file?

    $safe_filename = Utilidades::safeText($_FILES['file']['name']);
    if ($_FILES['file']['size'] <= $MAXIMUM_FILESIZE &&
            preg_match($rEFileTypes, strrchr($safe_filename, '.'))) {
        
        $isMove = move_uploaded_file(
                $_FILES['file']['tmp_name'], $dirBase . $safe_filename);
        //  TODO: redirect header
        if($isMove){
            //save image url, object etc.
            $oImagen = new Imagen();
            $oImagen->setNombre($safe_filename);
            $oImagen->setPath($GLOBAL_SETTINGS["news.img.path"]);
            
            $oNoticia = new Noticia();
            $oNoticia->setCuerpo($_POST['cuerpo']);
            $oNoticia->setTitulo($_POST['titulo']);
            $oNoticia->setImagen($oImagen);
            
            $manejador->addNoticia($oNoticia);
            //TODO: redirect noticias. o algo asi un mensaje ALGO jeje
            $everythingFine=true;
        }else{
            echo "Posible problemas de permisos: ";
            
        }
    }
} else {
    echo "Posible ataque del archivo subido: ";
    echo "nombre del archivo '" . $_FILES["file"]["tmp_name"] . "'.";
}

if($everythingFine){
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

        <script src="javascripts/modernizr.foundation.js"></script>
    </head>
    <body>

        <?php
        include_once 'admin_header.php';
        include_once 'admin_menu.php';
        $navigateTitle = "Noticia - Previsualización";
        include_once 'admin_navigate.php';
        
        ?>
	
		<!-- Three-up Content Blocks -->
                <div class="content">
                        <div class="row">
                            <div class="twelve columns">
                                <hr class="sin-margin-top" />
                            </div>
                            <div class="six columns">
                                <h4 class="destacado"><?php echo $oNoticia->getTitulo(); ?></h4>
                                <?php echo "<img src=\"".ROOT_URL."/".$GLOBAL_SETTINGS['news.img.path']."/".$safe_filename."\">";?>
                            </div>
                            <div class="six columns">
                                <h4 class="destacado"></h4>
                                <p class="text-justify"><?php echo $oNoticia->getCuerpo(); ?></p>
                            </div>
                        </div>
                    </div>
        


        <?php include_once 'admin_footer.php'; ?>
        <!-- Included JS Files (Compressed) -->
        <script src="javascripts/jquery.js"></script>
        <script src="javascripts/foundation.min.js"></script>

        <!-- Initialize JS Plugins -->
        <script src="javascripts/jquery.prettyPhoto.js"></script>
        <script src="javascripts/app.js"></script>
        <script src="javascripts/init.js"></script>

    </body>
</html>
<?php } ?>
