<?php
include 'admin_check.php';
include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/controladores/controlador_imagenes_slider.php';

$prevWidth = $GLOBAL_SETTINGS['news.img.slider.width'];
$prevHeight = $GLOBAL_SETTINGS['news.img.slider.height'];
$idNoticia = $_GET['idNoticia'];
$redirect = ROOT_URL . '/admin/noticias.php';
$isRedirect = true;
$oNoticia = new Noticia();
$oImagen = new Imagen();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $controladorImagenes = new ControladorImagenesSlider(ROOT_DIR . "/", $GLOBAL_SETTINGS["news.slider.path"]);
    $idNoticia = $_POST['idNoticia'];
    $idImagen = $_POST['idImagen'];
    
    $x = $_POST['x'];
    $y = $_POST['y'];
    $w = $_POST['w'];
    $h = $_POST['h'];
    
    $controladorImagenes->saveSlider($idImagen, $idNoticia,$prevWidth,$prevHeight,$x,$y,$w,$h);
    $isRedirect = true;
}else if(isset($idNoticia) && !empty($idNoticia)) {
    $manejador = new ManejadorServicios();
    $oNoticia = $manejador->getNoticiaById($idNoticia);
    //id returns valid noticia object
    if (isset($oNoticia) && !empty($oNoticia)) {
        $isRedirect = false; // I wont redirect unless noticia is a valid one
    }
}

if ($isRedirect) {
    header('Location: ' . $redirect);
    exit;
}
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
                            sliderWidth:$("#contenido").width(),
                            sliderHeight:<?php echo $prevHeight;?>
                        };
                    var jcropOptions = {
                            setSelect: [ 0, 0, config.sliderWidth ,config.sliderHeight],
                            aspectRatio: config.sliderWidth / config.sliderHeight,
                            onChange: showPreview,
                            boxWidth: config.sliderWidth,
                            onSelect: showPreview
                    }
                    $("#preview").css({width:config.sliderWidth});
                       
                    $("#imageSelect").change(function(e){
                        updateImgSrc();
                    });                    
                    //init jcrop
                    $('#target').Jcrop(jcropOptions,function(){
                        jcropObject=this;
                        updateImgSrc();
                    });
                    
                    function updateImgSrc(){
                        var imgSource = $("#imageSelect").find(":selected").val();
                        var imgId = $("#imageSelect").find(":selected").attr("data-bind");
                        $("#target").attr("src",imgSource);
                        $("#preview").attr("src",imgSource);
                        $('#idImagen').val(imgId);
                        jcropObject.setImage(imgSource,function(){
                            this.setOptions(jcropOptions);
                        });
                    }
                    
                    function showPreview(coords){
                        if(typeof jcropObject === 'undefined'){
                            return ;
                        };
                        var ratioX = config.sliderWidth / coords.w;
                        var ratioY = config.sliderHeight / coords.h;
                        var newWidth = Math.round(ratioX * jcropObject.getBounds()[0]) + 'px';
                        var newHeight = Math.round(ratioX * jcropObject.getBounds()[1]) + 'px';
                        
                        var cssValues = {
                            width: newWidth,
                            height: newHeight,
                            marginLeft: '-' + Math.round(ratioX * coords.x) + 'px',
                            marginTop: '-' + Math.round(ratioY * coords.y) + 'px'
                        }
                        
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
                <div  class="row">
                    <div id="contenido" class="twelve columns">
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
                                                echo '<option value="'.$imgSrc.'" data-bind="'.$oImagen->getId().'">'.$oImagen->getNombreArchivo().'</option>';
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
                            <div class="twelve columns">
                            <?php
                                echo '<div style="height:'.$prevHeight.'px;overflow:hidden;border: .2em dotted #'.$prevWidth.';">';
                                    echo'<img id="preview" src="" style="max-width:none;" >';
                                echo '</div>';
                            ?>
                            </div>
                            
                            <div class="twelve columns">
                                <div class="six columns">
                                    <div class="six columns">
                                        <!-- This is the form that our event handler fills -->
                                        <form action="?" method="POST" onsubmit="return checkCoords();">
                                            <input type="hidden" id="x" name="x" />
                                            <input type="hidden" id="y" name="y" />
                                            <input type="hidden" id="w" name="w" />
                                            <input type="hidden" id="h" name="h" />
                                            <input type="hidden" id="tw" name="tw" />
                                            <input type="hidden" id="th" name="th" />
                                            <input type="hidden" id="idImagen" name="idImagen" />
                                            <input type="hidden" id="idNoticia" name="idNoticia" value="<?php echo $idNoticia?>" />
                                            <input type="submit" class="radius button" value="Guardar" />
                                        </form>
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