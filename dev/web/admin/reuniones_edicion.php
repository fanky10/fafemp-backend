<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/reunion.php';
include_once ROOT_DIR . '/entidades/imagen.php';

$redirect = ROOT_URL . '/admin/reuniones.php';
$idReunion = $_GET['id'];
$isRedirect = true;
$oReunion = new Reunion();
//$oImagen = new Imagen();
// the id is valid
if (isset($idReunion) && !empty($idReunion)) {
    $manejador = new ManejadorServicios();
    $oReunion = $manejador->getReunionById($idReunion);
    //id returns valid noticia object
    if (isset($oReunion) && !empty($oReunion)) {
        $phpFecIni = strtotime($oReunion->getFechaInicio());
        $fechaInicio = date($GLOBAL_SETTINGS["reuniones.datepicker.formatter"], $phpFecIni);
        $phpFecFin = strtotime($oReunion->getFechaFin());
        $fechaFin = date($GLOBAL_SETTINGS["reuniones.datepicker.formatter"], $phpFecFin);
        $vImagenes = $oReunion->getImagenes();
        if (isset($vImagenes) && !empty($vImagenes)) {
            $oImagen = $vImagenes[0];
        }
        $isRedirect = false; // I wont redirect unless reunion is a valid one
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
                            $("#formReunion").valid();
                        }
                    });
                    $.validator.addMethod(
                        "validDateFormat",
                        function(value, element) {
                            return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
                        },
                        "Por favor ingrese la fecha en formato dd/mm/yyyy."
                    );
                    $.validator.addMethod(
                        "validMinDate",
                        function(value, element) {
                            var fechaInicio = parseDate($("#datepickerInicio").val());
                            var fechaFin = parseDate(value);

                            return fechaInicio<=fechaFin;
                        },
                        "Por favor ingrese una fecha de fin mayor a la de inicio."
                    );
                });
                // parse a date in dd/mm/yyyy
                function parseDate(input) {
                  var parts = input.match(/(\d+)/g);
                  // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
                  return new Date(parts[2], parts[1]-1, parts[0]); // months are 0-based
                }
            </script>
            <script type="text/javascript">
                $(function(){
                    $('#formReunion').validate({
                        rules: {
                            'titulo': 'required',
                            'cuerpo': 'required',
                            'fecha_inicio':{required:true,validDateFormat: true},
                            'fecha_fin':{
                                required: true,
                                validDateFormat: true,
                                validMinDate: true
                            }
                        },
                        messages: {
                            'titulo': 'Debe ingresar un titulo de reunion.',
                            'cuerpo': 'Debe ingresar un cuerpo a la reunion.',
                            'fecha_inicio': {
                                required:'Debe ingresar una fecha de inicio',
                                validDateFormat:'Debe ingresar una fecha con formato dd/mm/yyy'
                            },
                            'fecha_fin':{
                                required: 'Debe ingresar una fecha de fin',
                                validDateFormat:'Debe ingresar una fecha con formato dd/mm/yyy',
                                validMinDate: 'Debe ingresar una fecha de fin posterior a la de inicio'
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

            <!-- script para enviar un json del orden de las imagenes -->
            <script type="text/javascript">
                $(document).ready(function() {
                                                                                                                        
                    function createObject(id, position) {
                                                                                                                            
                        return {
                            "imagen.id": id,
                            "imagen.orden": position
                        }
                                                                                                                            
                    }
                                                                                                                        
                    $( "#imgSortable" ).sortable({
                        update: function(event, ui) {
                            var result = [];//new Array();
                            $("#imgSortable li").each(function(idx, item){
                                var id = $(item).attr('imageId');
                                var oRow = createObject(id,idx);
                                result.push(oRow);
                                                                                                                                    
                            });
                            //once we have the result let's show it!!
                            var jsonResult = JSON.stringify(result);
                            //once we know it works let's send it!!
                            $.post(
                            "imagenes_reunion_abm.php?action=updateOrder&id_reunion=<?php echo $oReunion->getId(); ?>",
                            {imgJSON: jsonResult},
                            function(response){
                                                                                                                
                                if(response.status=='ERROR'){
                                    $("#imgResponse").html('<div class="alert-box alert">'+response.mensaje+'.<a href="" class="close">&times;</a></div>');
                                }
                            });
                                                                                                                                
                        }
                    });
                    $( "#imgSortable" ).disableSelection();
                });
            </script>
            <!-- script para delete+updatear el set de las imagenes -->
            <script>
                                                                                    
                function deleteImage(imageId) {
                                                                                                                    
                    $.getJSON('imagenes_reunion_abm.php',
                    {
                        action:"del",
                        id_imagen:imageId
                    }, function(response){
                        if(response.status=='OK'){
                            //IF ok then 
                            $("#liImg"+imageId).fadeOut("slow", function() { 
                                $(this).remove(); 
                            });
                        }
                    });
                                                                                                                    
                }            
            </script>
            <script>
                                                                                    
                function submitForm() {
                                                                                                                    
                    $("#formReunion").submit();
                                                                                                                    
                }            
            </script>
        </head>
        <body>

            <?php
            include_once 'admin_header.php';
            include_once 'admin_menu.php';
            $navigateTitle = "Edicion reuniones";
            include_once 'admin_navigate.php';
            ?>

            <!-- Three-up Content Blocks -->
            <div class="content">
                <div class="row">
                    <!-- Contact Details -->
                    <div class="nine columns">
                        <h3>Carga Reuniones</h3>
                        <p>Desde el siguiente formulario usted prodrá ingresar nuevas
                            reuniones, que quedarán visibles desde el sitio público!.</p>
                        <?php
                        $formAction = "reuniones_abm.php?action=edit&id=" . $oReunion->getId();
                        echo '<form id="formReunion"action="' . $formAction . '" method="POST"
                              enctype="multipart/form-data">';
                        ?>
                        <h5>Formulario de Reunion</h5>
                        <label for="nombre">Titulo</label> 
                        <input type="text" class="twelve required" name="titulo" id="titulo" value="<?php echo $oReunion->getTitulo() ?>"/>
                        <div class="row">
                            <div class="twelve columns">
                                <label for="descripcion">Cuerpo Reunion</label>
                                <textarea rows="4" id="cuerpo" class="required" name="cuerpo"><?php echo $oReunion->getCuerpo() ?></textarea>
                            </div>
                            <div class="twelve columns">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="text" id="datepickerInicio" name="fecha_inicio" value="<?php echo $fechaInicio ?>"/>
                            </div>
                            <div class="twelve columns">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="text" id="datepickerFin" name="fecha_fin" value="<?php echo $fechaFin ?>"/>
                            </div>
                            <div class="twelve columns">
                                <label for="imagen">Agregar Imagenes</label> 
                                <input type="file" class="twelve" name="fileImage[]" id="file" multiple="true"/>
                            </div>
                            <div class="twelve columns">
                                <br><br>
                            </div>
                            <div class="twelve columns">
                                <?php
                                $vImagenes = $oReunion->getImagenes();
                                if (isset($vImagenes) && !empty($vImagenes)) {
                                    echo '<a class="secondary button" data-reveal-id="confirmImageChanges" title="editarImagenes" href="#">Mover ó eliminar imagenes</a>';
                                } else {
                                    echo '<a class="secondary button disabled" title="editarImagenes" href="#">Mover ó eliminar imagenes</a>';
                                }
                                ?>

                            </div>
                            <div class="twelve columns">
                                <br><br>
                            </div>
                            <div class="twelve columns">
                                <div class="six columns">
                                    <div class="six columns">
                                        <a href="#" data-reveal-id="myModal"><button class="radius button">Guardar</button></a> 
                                    </div>
                                    <div class="six columns">
                                        <a class="button radius" title="cancelar" href="reuniones.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo '</form>' ?>

                    </div>
                </div>
            </div>

            <?php include_once 'admin_footer.php'; ?>
            <!-- modals! -->
            <div id="confirmImageChanges" class="reveal-modal">
                <h3>Elimina o cambia el orden de las imagenes</h3>
                <label class="error" >
                    <p>Importante: Una vez eliminadas las imagenes no se podran deshacer los cambios.</p>
                </label>
                <?php
                $imgWidth = $GLOBAL_SETTINGS['news.img.preview.width'];
                $imgHeight = $GLOBAL_SETTINGS['news.img.preview.height'];
                $vImagenes = $oReunion->getImagenes();
                if (isset($vImagenes) && !empty($vImagenes)) {
                    echo '<ul id="imgSortable" style="list-style-type:none;" >';
                    foreach ($vImagenes as $oImagen) {
                        if (isset($oImagen)) {
                            $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombreArchivo();
                            echo '<li id="liImg' . $oImagen->getId() . '" imageId="' . $oImagen->getId() . '" class="ui-state-default">
                                            <img src="' . $img . '" ' . '" width=15%" ' .
                            '</img><button onclick="deleteImage(' . $oImagen->getId() . '); return false;" style="Position:Absolute;  left:50%;" class="secondary button" >Eliminar</button>' .
                            '</li>';
                        }
                    }
                    echo '</ul>';
                } else {//no images
                }
                ?>
                <a class="close-reveal-modal">&#215;</a>
                <a class="button radius" title="aceptar" href="">Cerrar</a>
            </div>

            <div id="myModal" class="reveal-modal">
                <h2>Confirmacion</h2>
                <p class="lead">Si estas seguro de los cambios realizados presiona aceptar.</p>
                <a class="close-reveal-modal">&#215;</a>
                <button type="submit" name="submit" onclick="submitForm();" class="radius button">Aceptar</button>
                <a class="button radius" title="cancelar" href="">Cancelar</a>
            </div>
        </body>
    </html>
    <?php
}
?>
