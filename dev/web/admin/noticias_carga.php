<?php include 'admin_check.php' ?>
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
        $aditionalTitle = "- Carga noticias";
        include_once 'admin_header.php';
        ?>
        <div class="menu">

            <div class="row">
                <!-- Contact Details -->
                <div class="nine columns">
                    <h3>Carga Noticias</h3>
                    <p>Desde el siguiente formulario usted prodra ingresar nuevas noticias, que quedaras visibles desde el sitio publico!.</p>
                    <form action="noticias_add.php" method="POST" enctype="multipart/form-data">
                        <h5>Formulario de Noticia</h5>
                        <label for="nombre">Titulo</label>
                        <input type="text" class="twelve required" name="titulo" id="titulo" />
                        <div class="row">
                            <div class="twelve columns">
                                <label for="descripcion">Cuerpo Noticia</label>
                                <textarea rows="4" id="descripcion" class="required" name="cuerpo"></textarea>
                            </div>
                            <div class="twelve columns">
                                <label for="imagen">Selecciona Imagen</label>
                                <input type="file" class="twelve required" name="file" id="file" />
                            </div>
                            <div class="twelve columns">
                                <br/>
                            </div>
                            <div class="twelve columns">
                                <button type="submit" name="submit" class="radius button">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->


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
