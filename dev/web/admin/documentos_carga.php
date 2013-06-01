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

        <script src="../javascripts/modernizr.foundation.js"></script>
    </head>
    <body>

        <?php
        include_once 'admin_header.php';
        include_once 'admin_menu.php';
        $navigateTitle = "Carga documentos";
        include_once 'admin_navigate.php';
        ?>

        <!-- Three-up Content Blocks -->
        <div class="content">
            <div class="row">
                <!-- Contact Details -->
                <div class="nine columns">
                    <h3>Carga Documentos</h3>
                    <p>Desde el siguiente selector usted prodrá ingresar nuevos
                        documentos, que quedarán visibles desde el sitio público!.</p>
                    <form id="formDocumento"action="documentos_abm.php?action=add" method="POST"
                          enctype="multipart/form-data">
                        <h5>Documentos:</h5>
                        <div class="row">
                            <div class="twelve columns">
                                <label for="imagen">Selecciona Documentos</label> 
                                <input type="file" class="twelve" name="fileDoc[]" id="file" multiple="true"/>
                            </div>
                            
                            <div class="twelve columns">
                                <br/>
                            </div>
                            <div class="twelve columns">
                                <div class="six columns">
                                    <div class="six columns">
                                        <button type="submit" name="submit" class="radius button">Guardar</button> </div>
                                    <div class="six columns">
                                        <a class="button radius" title="cancelar" href="documentos.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                    </form>
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
