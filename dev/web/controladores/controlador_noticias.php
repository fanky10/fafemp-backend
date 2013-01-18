<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';

class ControladorNoticias {

    protected $maxFileSize;
    protected $fileTypes;
    protected $dirBase;
    protected $manejador;
    protected $imgPath;

    public function __construct($dirBase, $imgPath) {
        $this->dirBase = $dirBase; //ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/";
        $this->fileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $this->manejador = new ManejadorServicios();
        $this->maxFileSize = 5 * 1024 * 1024; //take it from config
        $this->imgPath = $imgPath; //$GLOBAL_SETTINGS["news.img.path"]
    }

    public function subirNoticia() {
        echo "debug loco!";
        $oNoticia = new Noticia();
        $oNoticia = $this->agregaNoticia();
        $oImagenes = $this->subeMultiplesImagenes($oNoticia->getId());
        $oNoticia->setImagenes($oImagenes);
        return $oNoticia;
    }

    private function agregaNoticia() {
        $oNoticia = new Noticia();
        $oNoticia->setCuerpo($_POST['cuerpo']);
        $oNoticia->setTitulo($_POST['titulo']);
        $oNoticia->setId(1);
        //TODO: agregar la noticia -> setID
        return $oNoticia;
    }

    private function subeMultiplesImagenes($noticiaId) {
        $arrItems = Array();
        $index = 0;
        echo "<!--";
        foreach ($_FILES['fileImage']['name'] as $index => $name) {

            if ($_FILES['fileImage']['error'][$index] == 4) {
                continue;
            }

            if ($_FILES['fileImage']['error'][$index] == 0) {
                $file['name'] = $_FILES['fileImage']['name'][$index];
                $file['type'] = $_FILES['fileImage']['type'][$index];
                $file['tmp_name'] = $_FILES['fileImage']['tmp_name'][$index];
                $file['error'] = $_FILES['fileImage']['error'][$index];
                $file['size'] = $_FILES['fileImage']['size'][$index];
                $oImagen = $this->subeImagen($file, $noticiaId);
                $arrItems[$index] = $oImagen;
                $index++;
            }
        }
        echo "-->";
        return $arrItems;
    }

    private function subeImagen($file, $noticiaId) {

        $msgError = "";
        $error_types = array(
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
            'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
            'The uploaded file was only partially uploaded.',
            'No file was uploaded.',
            6 => 'Missing a temporary folder.',
            'Failed to write file to disk.',
            'A PHP extension stopped the file upload.'
        );
        $oImagen = null;
        ;
        $isFile = is_uploaded_file($file["tmp_name"]);
        if ($file["error"] > 0 && $file["error"] != 4) {//subio algo o no jeje
            $msgError = $error_types[$file['error']];
        } else if ($isFile) {    //  do we have a file?
            //add the ctstamp
            $formattedDate = strftime('%d%m%Y'); //Dia-Mes-Anio todo en nros.
            $safe_filename = Utilidades::safeText($formattedDate . '-' . baseName($file['name']));
            if ($file['size'] <= $this->maxFileSize &&
                    preg_match($this->fileTypes, strrchr($safe_filename, '.'))) {

                $isMove = move_uploaded_file(
                        $file['tmp_name'], $this->dirBase . $safe_filename);
                if ($isMove) {
                    //save image url, object etc.
                    $oImagen = new Imagen();
                    $oImagen->setNombre($safe_filename);
                    $oImagen->setPath($this->imgPath);
                    $this->manejador->addImagenNoticia($oImagen, $noticiaId);
                    return $oImagen;
                } else {
                    //echo "Posible problemas de permisos: ";
                    // no me importa, la subo sin imagen jeje
                }
            }
        }
        
        return null;
    }

}
?>