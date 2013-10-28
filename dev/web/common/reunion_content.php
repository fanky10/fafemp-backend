<?php
//include_once '../init.php';
include_once ROOT_DIR . '/util/utilidades.php';
?>
<!-- Three-up Content Blocks -->
<div class="content">
    <div class="row">
        <div class="twelve columns">
            <hr class="sin-margin-top" />
        </div>
        <div class="twelve columns">
            <p class="destacado" style="text-transform: uppercase;">
                <?php
                $timestamp = time();
                $reunionFecHr = $oReunion->getFechaInicio();
                if (isset($reunionFecHr)) {
                    $timestamp = strtotime($reunionFecHr);
                }
                //handle strftime
                $formattedDate = strftime($GLOBAL_SETTINGS['news.date.formatter'], $timestamp);
                echo $formattedDate;
                ?>
            </p>
            <h3 class="destacado">
                <?php
                echo $oReunion->getTitulo();
                ?>
            </h3>

        </div>
        <div id="imgContent" class="six columns">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        $imgWidth = $GLOBAL_SETTINGS['news.img.preview.width'];
                        $imgHeight = $GLOBAL_SETTINGS['news.img.preview.height'];
                        $vImagenes = $oReunion->getImagenes();
                        if (isset($vImagenes) && !empty($vImagenes)) {
                            foreach ($vImagenes as $oImagen) {
                                if (isset($oImagen)) {
                                    $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombreArchivo();
                                    echo "<li>";
                                    echo '<img src="' . $img . '" />';
                                    //echo '<a href="' . $img . '" rel="prettyPhoto[images]"><img src="' . $img . '" /></a>';
                                    echo "</li>";
                                }
                            }
                        } else {//no images
                            $img = "http://placehold.it/" . $imgWidth . "x" . $imgHeight . "/E9E9E9&text=Sin imagen";
                            echo "<li>";
                            echo '<img src="' . $img . '" />';
                            //echo '<a href="' . $img . '" rel="prettyPhoto[images]"><img src="' . $img . '" /></a>';
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </section>
        </div>
        <div class="six columns">
            <?php
            $cuerpoBreakeLines = Utilidades::breakeLines($oReunion->getCuerpo());
            $cuerpo = Utilidades::convertLinkYouTube($cuerpoBreakeLines);
            $cuerpo = str_replace('\"', '"', $cuerpo);
            ?>
            <p class="text-justify"><?php echo $cuerpo; ?></p>
        </div>
       	
        <div class="one columns" ></div>
        <div id="imgResponse" class="nine columns" >
                <?php
                $imgWidth = $GLOBAL_SETTINGS['news.img.preview.width'];
                $imgHeight = $GLOBAL_SETTINGS['news.img.preview.height'];
                $vDocumentos = $oReunion->getDocumentos();
                if (isset($vDocumentos) && !empty($vDocumentos)) {
                echo "<h4 class=\"destacado\">Lista de documentos:</h4>";
                echo "<ul style=\"list-style-type:none;\">";
                    foreach ($vDocumentos as $oDocumento) {
                        if (isset($oDocumento)) {
                            $doc = ROOT_URL . "/" . $oDocumento->getPath() . "/" . $oDocumento->getNombreArchivo();
                            $nombreDoc = $oDocumento->getNombreArchivo();
                            echo "<li>";
                            echo "<p>";
                            echo '<a href="' . $doc . '"><img src="'.ROOT_URL.'/images/soft-scraps-download-icon.png" style="Position:Absolute;  right:50%;" />' . $nombreDoc . '</a>';
                            
                            echo "</p>";
                            echo "</li>";
                        }
                    }
                echo "</ul>";
                } 
                ?>
        </div>
        <div class="two columns" ></div>
    </div>
</div>