<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';

$redirect = ROOT_URL . '/admin/noticias.php';
$idNoticia = $_GET['idNoticia'];
$isRedirect = true;
$oNoticia = new Noticia();
$oImagen = new Imagen();
// the id is valid
if (isset($idNoticia) && !empty($idNoticia)) {
    $manejador = new ManejadorServicios();
    $oNoticia = $manejador->getNoticiaById($idNoticia);
    //id returns valid noticia object
    if (isset($oNoticia) && !empty($oNoticia)) {
        $isRedirect = false; // I wont redirect unless noticia is a valid one
    }
}
if ($isRedirect) {
    header('Location: ' . $redirect);
    return;
} else {
    $prevWidth = 900;
    $prevHeight = $GLOBAL_SETTINGS['news.img.slider.height'];
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
            <link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />

            <!-- Attach the Reveal includes
            <script src="../javascripts/jquery.foundation.reveal.js"></script>
            <link rel="stylesheet" href="../stylesheets/reveal.css">

            <!-- Included JS Files (Compressed) 
            <script src="../javascripts/foundation.min.js"></script>

            <!-- Initialize JS Plugins 
            
            <script src="../javascripts/jquery.prettyPhoto.js"></script>
            <script src="../javascripts/app.js"></script>
            <script src="../javascripts/init.js"></script>
            <script src="../javascripts/filterdiv.js"></script>
            
            <!-- librerias para el manejo del cropping -->
            <script src="../javascripts/jcrop/jquery.min.js"></script>
            <script src="../javascripts/jcrop/jquery.Jcrop.js"></script>
            
            <!-- script llamador de las funciones.. como el main() -->
            <script>
                $(document).ready(function () {
                    var jcropObject;
                    var config = {
                            sliderWidth:<?php echo $prevWidth;?>,
                            sliderHeight:<?php echo $prevHeight;?>
                        };
                    var jcropOptions = {
                            setSelect: [ 0, 0, config.sliderWidth ,config.sliderHeight],
                            aspectRatio: config.sliderWidth / config.sliderHeight,
                            onChange: showPreview,
                            onSelect: showPreview
                    }
                       
                    $("#imageSelect").change(function(e){
                        var imgSource = $(this).val();
                        $("#target").attr("src",imgSource);
                        $("#preview").attr("src",imgSource);
                        jcropObject.setImage(imgSource,function(){
                            this.setOptions(jcropOptions);
                        });
                        
                    });
                    //init jcrop
                    $('#target').Jcrop(jcropOptions,function(){
                        jcropObject=this;
                    });
                    
                    
                    function showPreview(coords){
                        var targetWidth = $('.jcrop-holder').width();
                        var targetHeight = $('.jcrop-holder').height();
                        var ratioX = config.sliderWidth / coords.w;
                        var ratioY = config.sliderHeight / coords.h;
                        
                        var cssValues = {
                            width: Math.round(ratioX * targetWidth) + 'px',
                            height: Math.round(ratioY *  targetHeight) + 'px',
                            marginLeft: '-' + Math.round(ratioX * coords.x) + 'px',
                            marginTop: '-' + Math.round(ratioY * coords.y) + 'px'
                        }
                        console.log('ratio: x,y '+ratioX+','+ratioY);
                        console.log('values: ['+cssValues.width + ',' + cssValues.height +']');
                        console.log('margins:  '+cssValues.marginLeft+' x '+cssValues.marginTop);
                        $("#preview").css(cssValues);
                        
                        updateCoords(coords);
                    }

                    function updateCoords(c){
                        $('#x').val(c.x);
                        $('#y').val(c.y);
                        $('#w').val(c.w);
                        $('#h').val(c.h);
                    };
                    
                });
            </script>
            
            <!-- Author -->
            <link type="text/plain" rel="author" href="humans.txt" />

            
        </head>
        <body>

            <?php
            include_once 'admin_header.php';
            include_once 'admin_menu.php';
            $navigateTitle = "Edicion Presentación";
            include_once 'admin_navigate.php';
            ?>

            <!-- Three-up Content Blocks -->
            <div class="content">
                <div class="row">
                    <div class="nine columns">
                        <h3>Edicion Presentación</h3>
                        <p>Desde el siguiente formulario usted prodra editar la presentación de la noticia!</p>

                        <h5>Formulario de Slider</h5>
                        

                        <div class="row">
                            <div class="twelve columns">
                                <label >Seleccione una imagen</label>
                                <select id="imageSelect">
                                    <?php 
                                        $vImagenes = $oNoticia->getImagenes();
                                        if (isset($vImagenes) && !empty($vImagenes)) {
                                            foreach ($vImagenes as $oImagen) {
                                                $imgSrc = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombreArchivo();
                                                echo '<option value="'.$imgSrc.'" data-bind="'.$imgSrc.'">'.$oImagen->getNombreArchivo().'</option>';
                                            }
                                        } else {//no images
                                        }  
                                    ?>
                                </select>
                            </div>
                            <!-- imagen original -->
                            <div class="twelve columns">
                                <img id="target" src="" >
                                
                            </div>
                            <!-- imagen preview -->
                            <?php
                                echo '<div style="width:'.$prevWidth.'px;height:'.$prevHeight.'px;overflow:hidden;border: .2em dotted #'.$prevWidth.';">';
                                    echo'<img id="preview" src="" style="max-width:none;" >';
                                echo '</div>';
                            ?>

                            
                            <div class="twelve columns">
                                <!-- This is the form that our event handler fills -->
                                <form action="?" method="POST" onsubmit="return checkCoords();">
                                    <input type="hidden" id="x" name="x" />
                                    <input type="hidden" id="y" name="y" />
                                    <input type="hidden" id="w" name="w" />
                                    <input type="hidden" id="h" name="h" />
                                    <input type="hidden" id="tw" name="tw" />
                                    <input type="hidden" id="th" name="th" />
                                    <input type="submit" value="Crop Image" />
                                </form>
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

                    </div>
                </div>
            </div>
    <?php include_once 'admin_footer.php'; ?>

        </body>
        
    </html>
<?php } ?>