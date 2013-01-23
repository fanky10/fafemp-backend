<?php include 'admin_check.php' ?>
<?php
include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';

$redirect = ROOT_URL . '/admin/noticias.php';
$idNoticia = $_GET['id'];
$isRedirect = true;
$oNoticia = new Noticia();
//$oImagen = new Imagen();
// the id is valid
if (isset($idNoticia) && !empty($idNoticia)) {
    $manejador = new ManejadorServicios();
    $oNoticia = $manejador->getNoticiaById($idNoticia);
    //id returns valid noticia object
    if (isset($oNoticia) && !empty($oNoticia)) {
        $vImagenes = $oNoticia->getImagenes();
        if (isset($vImagenes) || !empty($vImagenes)) {
            $oImagen = $vImagenes[0];
        }
        $isRedirect = false;// I wont redirect unless noticia is a valid one
    }
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
        </head>
        <body>

            <?php
            include_once 'admin_header.php';
            include_once 'admin_menu.php';
            $navigateTitle = "Carga noticias";
            include_once 'admin_navigate.php';
            ?>

            <!-- Three-up Content Blocks -->
            <div class="content">
                <div class="row">
                    <!-- Contact Details -->
                    <div class="nine columns">
                        <h3>Carga Noticias</h3>
                        <p>Desde el siguiente formulario usted prodra editar la noticia seleccionada!.</p>
                        <?php
                        $formAction = "noticias_add.php?action=edit&id=" . $oNoticia->getId();
                        echo '<form id="formNoticia"action=' . $formAction . '" method="POST"
                              enctype="multipart/form-data">';
                        ?>

                        <h5>Formulario de Noticia</h5>
                        <label for="nombre">Titulo</label> 
                        <?php
                        echo '<input type="text" class="twelve required" name="titulo" id="titulo" value="' . $oNoticia->getTitulo() . '"/>';
                        ?>

                        <div class="row">
                            <div class="twelve columns">
                                <label for="descripcion">Cuerpo Noticia</label>
                                <?php
                                echo '<textarea rows="4" id="cuerpo" class="required" name="cuerpo">' . $oNoticia->getCuerpo() . '</textarea>';
                                ?>

                            </div>
                            <div class="twelve columns">
                                <label for="imagen">Selecciona Imagen</label> 
                                <input type="file" class="twelve" name="fileImage[]" id="file" multiple="true"/>
                            </div>
                            <div class="twelve columns">
                                <br/>
                                <h4>Aqui carousel de imagenes!</h4>
                            </div>
                            <div class="twelve columns">
                                <button type="submit" name="submit" class="radius button">Guardar</button>
                            </div>
                        </div>
                        <?php
                        echo '</form>';
                        ?>

                    </div>
                </div>
            </div>



            <?php include_once 'admin_footer.php'; ?>
            <!-- Included JS Files (Compressed) -->
            <script src="../javascripts/jquery.js"></script>
            <script src="../javascripts/foundation.min.js"></script>

            <!-- Initialize JS Plugins -->
            <script src="../javascripts/jquery.prettyPhoto.js"></script>
            <script src="../javascripts/jquery_validate.js"></script>
            <script src="../javascripts/app.js"></script>
            <script src="../javascripts/init.js"></script>
            <script type="text/javascript">
                $(function(){
                    $('#formNoticia').validate({
                        rules: {
                            'titulo': 'required',
                            'cuerpo': 'required'
                        },
                        messages: {
                            'titulo': 'Debe ingresar un titulo de noticia.',
                            'cuerpo': 'Debe ingresar un cuerpo a la noticia.'
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
                $(document).ready(function(){
                    $("a[rel^='prettyPhoto']").prettyPhoto({
                        theme: 'facebook',
                        social_tools: false
                    });
                });
            </script>

        </body>
    </html>
<?php } ?>
