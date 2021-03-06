<?php
include_once 'init.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
// pagina pedida
$pag = 1;
if (isset($_GET["pag"])) {
    $pag = (int) $_GET["pag"];
}
$limit = $GLOBAL_SETTINGS['news.per.page'];
$offset = ($pag - 1) * $limit; //donde empieza a mostrar
$paginacionLimit = $GLOBAL_SETTINGS['news.page.limit'];
$manejador = new ManejadorServicios();
$vNoticias = $manejador->getNoticiasPaginadas($offset, $limit);
$totalNoticias = $manejador->getCantidadNoticias();
$imgWidth = $GLOBAL_SETTINGS['news.img.preview.width'];
$imgHeight = $GLOBAL_SETTINGS['news.img.preview.height'];
$limiteCuerpo = $GLOBAL_SETTINGS['news.body.limit'];
if (!isset($vNoticias) || empty($vNoticias)) {
    ?>
    <div class="content">
        <div class="row">
            <div class="twelve columns">
                <hr class="sin-margin-top" />

            </div>
            <div class="twelve columns">
                <h3>Proximamente noticias...</h3>
            </div>

        </div>
    </div>

    <?php
} else {

    $oNoticia = new Noticia();
    $oImagen = new Imagen();

    $noticiasCount = count($vNoticias);
    //creamos un arreglo multidimensional (x
    // cada row tiene la cant de elementos corresp.
    $tableData[] = array();
    $row = array();
    $itemCount = 0;
    $rowCount = 0;
    foreach ($vNoticias as $oNoticia) {
        $vImagenes = $oNoticia->getImagenes();
        $imgSrc = "http://placehold.it/" . $imgWidth . "x" . $imgHeight . "/E9E9E9&text=Sin imagen";
        $link = ROOT_URL . "/noticia.php?id=" . $oNoticia->getId();
        if (isset($vImagenes) && !empty($vImagenes)) {
            $oImagen = $vImagenes[0];
            $idImg = $oImagen->getId();
            if (isset($oImagen) && isset($idImg)) {
                $imgSrc = ROOT_URL . "/" . $oImagen->getPath() . "/" . $oImagen->getNombreArchivo();
            }
        }
        $shortenText = Utilidades::acortaTexto($oNoticia->getCuerpo(), $limiteCuerpo, ".");
        $shortenText = Utilidades::breakeLines($shortenText);
        echo '<div class="row">';
        echo '<div class="twelve columns"><h3>' . $oNoticia->getTitulo() . '</div>';
        echo '<div class="four columns">';
        echo '<a href="' . $link . '"><img src="' . $imgSrc . '" witdh="' . $imgWidth . '" height="' . $imgHeight . '"></a>';
        echo '</div>';
        echo '<div class="eight columns">';
        echo '<p>';
        echo $shortenText;
        echo '</p>';
        echo '<a class="button radius" title="Ver más" href="' . $link . '">Más detalles</a>';
        echo '</div>';
        echo '</div>';
    }
}
//TODO: paginacion??
// a piece of code!
?>
<!-- Aqui va el foot de paginacion -->

<!-- paginacion -->
<div class="row">
    <hr/>
    <div class="twelve columns">
        <?php
        if($totalNoticias==0){
            return ;
        }
        //cual es la pagina de inicio, si estamos mas alla del limite, mostrar la anterior
        $paginaInicio = ($pag > $paginacionLimit ? $pag - 1 : 1); //
        $pagFin = ceil($totalNoticias / $limit); //saco el total de las paginas
        //el numero de paginas a mostrar = configuradas
        $totalPag = $paginacionLimit;
        if ($pag > $paginacionLimit) {//excepto que ya la hayamos pasado
            $totalPag = $pag + $paginacionLimit; //le sumamos el limite
        }
        if ($totalPag > $pagFin) {//tenemos pocos elementos y la pagina de fin es mas grande que la ultima pagina
            $totalPag = $pagFin;
        }
        echo '<ul class="pagination">';
        //flecha volver
        $hrefAnterior = "?pag=" . ($pag - 1);
        if ($pag == 1) {
            echo '<li class="arrow unavailable">«</li>';
        } else if ($pag > 1) {
            echo '<li class="arrow"><a href="' . $hrefAnterior . '">«</a></li>';
        }
        $links = array();
        for ($i = $paginaInicio; $i <= $totalPag; $i++) {//muestro c/una de las paginas
            $href = "?pag=" . $i;
            if ($i == $pag) {
                $href = "";
                $links [] = "<li class=\"current\"><a href=\"$href\">$i</a></li>";
            } else {
                $links [] = "<li><a href=\"$href\">$i</a></li>";
            }
        }
        echo implode("", $links);
        //es necesario poner el .. [ultima pagina]?
        //TODO: check si es necesario
        //si estamos por debajo de 2 paginas de la de fin then show
        if ($totalPag < $pagFin) {
            echo '<li class="unavailable">…</li>';
            echo '<li><a href="">' . $pagFin . '</a></li>';
        }
        //arrow siguiente
        $hrefPosterior = "?pag=" . ($pag + 1);
        if ($pag == $pagFin) {
            echo '<li class="arrow unavailable">»</li>';
        } else {
            echo '<li class="arrow"><a href="' . $hrefPosterior . '">»</a></li>';
        }
        echo "</ul>";
        ?>
    </div>
</div>