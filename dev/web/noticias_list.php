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
$noticiasPorLinea = $GLOBAL_SETTINGS['news.per.row'];
$manejador = new ManejadorServicios();
$vNoticias = $manejador->getNoticias($limit); //just one row for now.   
/**
 * $offset = ($pag-1) * $limit;//donde empieza a mostrar
  $dProd = new DataProductos();
  $vProds = $dProd->getProductosImagen($offset,$limit,$id_categoria, $order);//traigo los de prueba no mas
  $total = $dProd->getCountProducts();//el total tiene que 'venir' de la db
 */
if (!isset($vNoticias) || empty($vNoticias)) {
    ?>
    <div class="twelve columns"><h3>Próximamente Noticias</h3></div> 
    <div class="twelve columns">
        <div class="row">
            <div class="six columns">
                <h4>Noticia número 1</h4>
                <img src="http://placehold.it/451x150&amp;text=[img]">
                <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
                <a href="#" class="button radius" title="Ver más">Más detalles</a>
            </div>
            <div class="six columns">
                <h4>Noticia número 2</h4>
                <img src="http://placehold.it/451x150&amp;text=[img]">
                <p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
                <a href="#" class="button radius" title="Ver más">Más detalles</a>
            </div>
        </div>
        <hr />
    </div>

    <?php
} else {
    ?>
    <?php
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
        echo '<div class="row">';
        echo '<div class="twelve columns"><h3>'.$oNoticia->getTitulo().'</div>';
        echo '<div class="four columns">';
        //TODO: check img size (:
        echo '<img src="http://placehold.it/400x300&amp;text=[img]">';
        echo '</div>';
        echo '<div class="eight columns">';
        echo '<p>';
        //TODO: check max char count and cut it
        echo $oNoticia->getCuerpo();
        echo '</p>';
        //TODO: ver mas?
        echo '</div>';
        echo '</div>';
    }
    //TODO: paginacion??
}
?>
