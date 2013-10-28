<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/entidades/documento.php';

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
        if (isset($vImagenes) && !empty($vImagenes)) {
            $oImagen = $vImagenes[0];
        }
        $vDocumentos = $oNoticia->getDocumentos();
        if (isset($vDocumentos) && !empty($vDocumentos)) {
            $oDocumento = $vDocumentos[0];
        }
        
        $isRedirect = false; // I wont redirect unless noticia is a valid one
    }
}
if ($isRedirect) {
    header('Location: ' . $redirect);
    return;
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


            <!-- Included CSS Files (Compressed) -->
            <link rel="stylesheet" href="../stylesheets/app.css">
            <link rel="stylesheet" href="../stylesheets/prettyPhoto.css">
            <link rel="stylesheet" href="../stylesheets/foundation.css">

            <!-- Attach the Reveal includes-->
            <script src="../javascripts/jquery.foundation.reveal.js"></script>
            <link rel="stylesheet" href="../stylesheets/reveal.css">

            <!-- Included JS Files (Compressed) -->
            <script src="../javascripts/jquery.js"></script>
            <script src="../javascripts/foundation.js"></script>
            <script src="../javascripts/foundation.min.js"></script>

            <!-- Initialize JS Plugins -->
            <script src="../javascripts/jquery.prettyPhoto.js"></script>
            <script src="../javascripts/jquery_validate.js"></script>
            <script src="../javascripts/app.js"></script>
            <script src="../javascripts/init.js"></script>
            <script src="../javascripts/filterdiv.js"></script>


            <!-- Todo lo referido al draggin de imagenes -->
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
            <script src="../javascripts/jquery-ui-1.9.2.custom.min.js"></script>


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

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#confirmModal').click(function() {
                        $('#confirmModal').reveal();
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
                            "imagenes_noticia_abm.php?action=updateOrder&idNoticia=<?php echo $oNoticia->getId(); ?>",
                            {imgJSON: jsonResult},
                            function(response){
                                                                                                    
                                if(response.status=='ERROR'){
                                    $("#imgResponse").html('<div class="alert-box alert">'+response.mensaje+'.<a href="" class="close">&times;</a></div>');
                                }
                            });
                                                                                                                    
                        }
                    });
                    $( "#imgSortable" ).disableSelection();

                    $( "#docSortable" ).sortable({
                        update: function(event, ui) {
                            var result = [];//new Array();
                            $("#docSortable li").each(function(idx, item){
                                var id = $(item).attr('documentoId');
                                var oRow = createObject(id,idx);
                                result.push(oRow);
                                                                                                                        
                            });
                            //once we have the result let's show it!!
                            var jsonResult = JSON.stringify(result);
                            //once we know it works let's send it!!
                            $.post(
                            "documentos_noticia_abm.php?action=updateOrder&idNoticia=<?php echo $oNoticia->getId(); ?>",
                            {imgJSON: jsonResult},
                            function(response){
                                                                                                    
                                if(response.status=='ERROR'){
                                    $("#docResponse").html('<div class="alert-box alert">'+response.mensaje+'.<a href="" class="close">&times;</a></div>');
                                }
                            });
                                                                                                                    
                        }
                    });
                    $( "#docSortable" ).disableSelection();
                });
            </script>
            <!-- script para delete+updatear el set de las imagenes -->
            <script>
                                                                        
                function deleteImage(imageId,noticiaId) {
                                                                                                        
                    $.getJSON('imagenes_noticia_abm.php',
                    {
                        action:"del",
                        id_noticia:noticiaId,
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
            <!-- script para delete+updatear el set de los documentos -->
            <script>
                                                                        
                function deleteDocumento(documentoId,noticiaId) {
                                                                                                        
                    $.getJSON('documentos_noticia_abm.php',
                    {
                        action:"del",
                        id_noticia:noticiaId,
                        id_documento:documentoId
                    }, function(response){
                        if(response.status=='OK'){
                            //IF ok then 
                            $("#liImg"+documentoId).fadeOut("slow", function() { 
                                $(this).remove(); 
                            });
                        }
                    });
                                                                                                        
                }            
            </script>
            <script>
                                                                        
                function submitForm() {
                                                                                                        
                    $("#formNoticia").submit();
                                                                                                        
                }            
            </script>
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
                        $formAction = "noticias_abm.php?action=edit&id=" . $oNoticia->getId();
                        echo '<form id="formNoticia"action="' . $formAction . '" method="POST"
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
                                $cuerpo = str_replace('<br/>', "\n", Utilidades::breakeLines($oNoticia->getCuerpo()));
                                $cuerpo = str_replace('\"', '"', $cuerpo);
                                echo '<textarea rows="4" id="cuerpo" class="required" name="cuerpo">' . $cuerpo  . '</textarea>';
                                ?>

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
                                $vImagenes = $oNoticia->getImagenes();
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
                                <label for="imagen">Agregar Documentos</label> 
                                <input type="file" class="twelve" name="fileDoc[]" id="file" multiple="true"/>
                            </div>
                            <div class="twelve columns">
                                <br><br>
                            </div>
                            <!-- no se pueden eliminar desde aca, sino desde el panel gral. REDO
                            <div class="twelve columns">
                                <?php
                                $vDocumentos = $oNoticia->getDocumentos();
                                if (isset($vDocumentos) && !empty($vDocumentos)) {
                                    echo '<a class="secondary button" data-reveal-id="confirmImageChanges" title="editarDocumentos" href="#">Mover ó eliminar Documentos</a>';
                                } else {
                                    echo '<a class="secondary button disabled" title="editarDocumentos" href="#">Mover ó eliminar documentos</a>';
                                }
                                ?>

                            </div>
                            -->
                            <div class="twelve columns">
                                <?php
                                $vImagenes = $oNoticia->getImagenes();
                                if (isset($vImagenes) && !empty($vImagenes)) {
                                    echo '<a class="secondary button" title="editar slider" href="imagenes_slider_edicion.php?idNoticia='.$oNoticia->getId().'">Editar presentación</a>';
                                } else {
                                    echo '<a class="secondary button disabled" title="editar slider" href="#">Editar presentación</a>';
                                }
                                ?>

                            </div>
                            <div class="twelve columns">
                                <br><br>
                            </div>
                            <div class="twelve columns">
                                <div class="six columns">
                                    <div class="six columns">
                                        <!--<button type="submit" name="submit" class="radius button">Guardar</button> </div> -->
                                        <a href="#" data-reveal-id="myModal"><button class="radius button">Guardar</button></a> 
                                    </div>
                                    <div class="six columns">
                                        <a class="button radius" title="cancelar" href="noticias.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="twelve columns">
                                <br>
                            </div>
                            <div class="six columns">
                                <div id="imgResponse" class="twelve columns" >
                                </div>
                            </div>
                        </div>
                        <?php
                        echo '</form>';
                        ?>

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
                $vImagenes = $oNoticia->getImagenes();
                if (isset($vImagenes) && !empty($vImagenes)) {
                    echo '<ul id="imgSortable" style="list-style-type:none;" >';
                    foreach ($vImagenes as $oImagen) {
                        if (isset($oImagen)) {
                            $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombreArchivo();
                            echo '<li id="liImg' . $oImagen->getId() . '" imageId="' . $oImagen->getId() . '" class="ui-state-default">
                                            <img src="' . $img . '" ' . '" width=15%" ' .
                            '</img><button onclick="deleteImage(' . $oImagen->getId() . ',' . $oNoticia->getId() . '); return false;" style="Position:Absolute;  left:50%;" class="secondary button" >Eliminar</button>' .
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
<?php } ?>
