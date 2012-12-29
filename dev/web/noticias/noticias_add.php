<?php
include_once '../init.php';
include_once ROOT_DIR .'/entidades/noticia.php';
include_once ROOT_DIR .'/entidades/imagen.php';
include_once ROOT_DIR .'/servicios/manejador_servicios.php';
include_once ROOT_DIR .'/util/utilidades.php';

$manejador = new ManejadorServicios();
// validation
//  5MB maximum file size
// TODO: settings max file
$MAXIMUM_FILESIZE = 5 * 1024 * 1024;
//  Valid file extensions (images, word, excel, powerpoint)
$rEFileTypes =
        "/^\.(jpg|jpeg|gif|png|doc|docx|txt|rtf|pdf|xls|xlsx|
        ppt|pptx){1}$/i";
$dirBase = ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/";

$isFile = is_uploaded_file($_FILES["file"]["tmp_name"]);
if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else if ($isFile) {    //  do we have a file?

    $safe_filename = Utilidades::safeText($_FILES['file']['name']);
    if ($_FILES['file']['size'] <= $MAXIMUM_FILESIZE &&
            preg_match($rEFileTypes, strrchr($safe_filename, '.'))) {
        
        $isMove = move_uploaded_file(
                $_FILES['file']['tmp_name'], $dirBase . $safe_filename);
        //  TODO: redirect header
        if($isMove){
            //save image url, object etc.
            $oImagen = new Imagen();
            $oImagen->setNombre($safe_filename);
            $oImagen->setPath($GLOBAL_SETTINGS["news.img.path"]);
            
            $oNoticia = new Noticia();
            $oNoticia->setCuerpo($_POST['cuerpo']);
            $oNoticia->setTitulo($_POST['titulo']);
            $oNoticia->setImagen($oImagen);
            
            $manejador->addNoticia($oNoticia);
            //TODO: redirect noticias. o algo asi un mensaje ALGO jeje
        }else{
            echo "Posible problemas de permisos: ";
        }
    }
} else {
    echo "Posible ataque del archivo subido: ";
    echo "nombre del archivo '" . $_FILES["file"]["tmp_name"] . "'.";
}
?> 
<?php
echo "Preview!";
echo "<br/>";
/* 
 * forma de mostrarla (un poco de css aqui please!)
 * 
 */
echo "<img src=\"" . ROOT_URL. "/".$GLOBAL_SETTINGS["news.img.path"] . "/" . $safe_filename . "\" >";
?>
<br/>
<a href="upload_form.php">volver</a>
<?php //TODO ir a noticia!! con la url "generada" ?>
<a href="#">ir a noticia</a>