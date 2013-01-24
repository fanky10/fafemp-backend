<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';

class ControladorImagenes {

    protected $maxFileSize;
    protected $fileTypes;
    protected $dirBase;
    protected $manejador;
    protected $imgPath;

    public function __construct($dirBase, $imgPath) {
        $this->dirBase = $dirBase;
        $this->fileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i";
        $this->manejador = new ManejadorServicios();
        $this->maxFileSize = 5 * 1024 * 1024; //take it from config
        $this->imgPath = $imgPath;
    }

    public function subeMultiplesImagenes($noticiaId) {
        $arrItems = Array();
        $index = 0;
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
                $oImagen = $this->subeImagen($file, $noticiaId, $index);
                $arrItems[$index] = $oImagen;
                $index++;
            }
        }

        return $arrItems;
    }

    private function subeImagen($file, $noticiaId, $orden) {

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
            $safe_name = Utilidades::safeText(baseName($file['name']));
            if ($file['size'] <= $this->maxFileSize &&
                    preg_match($this->fileTypes, strrchr($safe_filename, '.'))) {

                $isMove = move_uploaded_file(
                        $file['tmp_name'], $this->dirBase . $safe_filename);
                if ($isMove) {
                    //save image url, object etc.
                    $oImagen = new Imagen();
                    $oImagen->setNombre($safe_name);
                    $oImagen->setNombreArchivo($safe_filename);
                    $oImagen->setPath($this->imgPath);
                    $oImagen->setOrden($orden);
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

    public function reorderImagenes() {
        $jsonReceived = $_POST['imgJSON'];
        $items = json_decode($jsonReceived);
        foreach ($items as $item) {//call updateImg
            $imageId = null;
            $imageOrder = null;
            foreach ($item as $property => $value) {
                if ($property == "imagen.id") {
                    $imageId = $value;
                }
                if ($property == "imagen.orden") {
                    $imageOrder = $value;
                }
            }
            if (isset($imageId) && isset($imageOrder)) {
                //get original img object to see if the id is cool
                $oImage = $this->manejador->getImagen($imageId);
                if (isset($oImage) && !empty($oImage)) {
                    $oImage->setOrden($imageOrder);
                    $this->manejador->editarImagen($oImage);
                } else {
                    $this->sendJSONResponseMessage("ERROR", "No se pudieron guardar los cambios, avise al administrador o intente nuevamente mas tarde");
                }
            }
        }
        $this->sendJSONResponseMessage("OK", "");
    }

    public function deleteImage($imageId) {
        $oImage = $this->manejador->getImagen($imageId);
        $oImage->setEliminada(1);
        $this->manejador->editarImagen($oImage);
        $this->sendJSONResponseMessage("OK", "");
    }

    public function getImagesJSON($idNoticia) {
        $oNoticia = $this->manejador->getNoticiaById($idNoticia);
        $vImagenes = $oNoticia->getImagenes();

        $vResponse = array();
        $idx = 0;
        foreach ($vImagenes as $imagen) {
            $object = new StdClass;
            $object->id = $imagen->getId();
            $object->nombre = $imagen->getNombre();

            $vResponse[$idx] = json_encode($object);
            $idx++;
        }
        header("Content-type: application/json");
        echo json_encode($vResponse);
    }

    function sendJSONResponseMessage($status, $mensaje) {
        header("Content-type: application/json");
        $responseMsg = new StdClass;
        $responseMsg->status = $status;
        $responseMsg->mensaje = $mensaje;
        echo json_encode($responseMsg);
    }

}

?>