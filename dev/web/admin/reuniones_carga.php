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
        <!-- Included JS Files (Compressed) -->
        <script src="../javascripts/jquery.js"></script>
        <script src="../javascripts/foundation.min.js"></script>

        <!-- Initialize JS Plugins -->
        <script src="../javascripts/jquery.prettyPhoto.js"></script>
        <script src="../javascripts/jquery_validate.js"></script>
        <script src="../javascripts/app.js"></script>
        <script src="../javascripts/init.js"></script>
        <!-- for i18n datepicker -->
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
        <script src="../javascripts/jquery.ui.datepicker-es.js"></script>
        <script>
            $(function() {
                $( "#datepickerInicio" ).datepicker({
                    onSelect: function(textoFecha, objDatepicker){
                        $("#datepickerFin").val(textoFecha);
                    }
                });
                $( "#datepickerFin" ).datepicker({
                    onSelect: function(textoFecha, objDatepicker){
                        //TODO: check if fechaFin >= fechaInicio
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('#formReunion').validate({
                    rules: {
                        'titulo': 'required',
                        'cuerpo': 'required',
                        'fecha_inicio':'required',
                        'fecha_fin':{
                            required: true
                            //min: 'fecha_inicio'
                            
                        }
                    },
                    messages: {
                        'titulo': 'Debe ingresar un titulo de reunion.',
                        'cuerpo': 'Debe ingresar un cuerpo a la reunion.',
                        'fecha_inicio': 'Debe ingresar una fecha de inicio',
                        'fecha_fin':{
                            required: 'Debe ingresar una fecha de fin'
                            //min: "La fecha de fin debe ser mayor a la fecha de inicio"
                        } 
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
    </head>
    <body>

        <?php
        include_once 'admin_header.php';
        include_once 'admin_menu.php';
        $navigateTitle = "Carga reuniones";
        include_once 'admin_navigate.php';
        ?>

        <!-- Three-up Content Blocks -->
        <div class="content">
            <div class="row">
                <!-- Contact Details -->
                <div class="nine columns">
                    <h3>Carga Noticias</h3>
                    <p>Desde el siguiente formulario usted prodrá ingresar nuevas
                        reuniones, que quedarán visibles desde el sitio público!.</p>
                    <form id="formReunion" action="reuniones_abm.php?action=add" method="POST"
                          enctype="multipart/form-data">
                        <h5>Formulario de Reunion</h5>
                        <label for="nombre">Titulo</label> 
                        <input type="text" class="twelve required" name="titulo" id="titulo" />
                        <div class="row">
                            <div class="twelve columns">
                                <label for="descripcion">Cuerpo Reunion</label>
                                <textarea rows="4" id="cuerpo" class="required" name="cuerpo"></textarea>
                            </div>
                            <div class="twelve columns">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="text" id="datepickerInicio" name="fecha_inicio" />
                            </div>
                            <div class="twelve columns">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="text" id="datepickerFin" name="fecha_fin"/>
                            </div>
                            <div class="twelve columns">
                                <label for="imagen">Selecciona Imagen</label> 
                                <input type="file" class="twelve" name="fileImage[]" id="file" multiple="true"/>
                            </div>
                            <div class="twelve columns">
                                <br/>
                            </div>
                            <div class="twelve columns">
                                <div class="six columns">
                                    <div class="six columns">
                                        <button type="submit" name="submit" class="radius button">Guardar</button> </div>
                                    <div class="six columns">
                                        <a class="button radius" title="cancelar" href="reuniones.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>



            <?php include_once 'admin_footer.php'; ?>


    </body>
</html>
