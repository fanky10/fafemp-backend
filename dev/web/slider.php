<div id="slider">
<?php
include_once 'init.php';
include_once ROOT_DIR .'/servicios/manejador_servicios.php';
include_once ROOT_DIR .'/entidades/noticia.php';
$manejador = new ManejadorServicios();
$noticias = $manejador->getNoticias($GLOBAL_SETTINGS['slider.size']);
?>
    <!-- fanky-vardump
    <?php
    var_dump($noticias);
    ?>
    -->
<?php
//TODO: cambiar esto por el servicio de noticias, chequear que la imagen exista, ponerle un link
$array = array(
    "Dynamic Title 1" ,
    "Dynamic Title 2" ,
    "Dynamic Title 3" ,
    "Dynamic Title 4" ,
);
$count = 1;
$oNoticia = new Noticia();
foreach ($noticias as $oNoticia){
    $title = $oNoticia->getTitulo();
    $link = "#";
    $img =  "http://placehold.it/970x290/E9E9E9&text=[img ".$count."]";
    echo '<a href="'.$link.'"><img src="'.$img.'" /><span class="slider-caption">'.$title.'</span></a>';
    $count++;
}

?>
</div>        