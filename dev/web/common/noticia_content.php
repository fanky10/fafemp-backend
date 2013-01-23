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
                $noticiaFecHr = $oNoticia->getFechaHora();
                if (isset($noticiaFecHr)) {
                    $timestamp = strtotime($oNoticia->getFechaHora());
                }
                //handle strftime
                $formattedDate = iconv('ISO-8859-1', 'UTF-8', strftime($GLOBAL_SETTINGS['news.date.formatter'], $timestamp));
                echo $formattedDate;
                ?>
            </p>
            <h3 class="destacado">
                <?php
                echo $oNoticia->getTitulo();
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
                        $vImagenes = $oNoticia->getImagenes();
                        if (isset($vImagenes) && !empty($vImagenes)) {
                            foreach ($vImagenes as $oImagen) {
                                if (isset($oImagen)) {
                                    $img = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombre();
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
            <p class="text-justify"><?php echo Utilidades::breakeLines($oNoticia->getCuerpo()); ?></p>
        </div>
    </div>
</div>