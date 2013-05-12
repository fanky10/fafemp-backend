<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/documento.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';

abstract class ControladorDocumentos {
    
    protected $maxFileSize;
    protected $fileTypes;
    protected $dirBase;
    protected $manejador;
    protected $docPath;

    public function __construct($dirBase, $docPath) {
        $this->dirBase = $dirBase;
        $this->fileTypes = "/^\.(doc|docx|pdf|xls|xlsx){1}$/i";
        $this->manejador = new ManejadorServicios();
        $this->maxFileSize = 30 * 1024 * 1024; //take it from config
        $this->docPath = $docPath;
    }
    
    /**
     * esto debe ser implementado segun convenga
     */
    protected abstract function getDocumentosGuardados();
    protected abstract function saveDocumento($safe_name,$safe_filename,$orden);

    public function subeMultiplesDocumentos() {
        $documentos = $this->getDocumentosGuardados();
        $orden = count($documentos);//ultimo lugar -- incluso si no hay ninguna.
        foreach ($_FILES['fileDoc']['name'] as $index => $name) {

            if ($_FILES['fileDoc']['error'][$index] == 4) {
                continue;
            }

            if ($_FILES['fileDoc']['error'][$index] == 0) {
                $file['name'] = $_FILES['fileDoc']['name'][$index];
                $file['type'] = $_FILES['fileDoc']['type'][$index];
                $file['tmp_name'] = $_FILES['fileDoc']['tmp_name'][$index];
                $file['error'] = $_FILES['fileDoc']['error'][$index];
                $file['size'] = $_FILES['fileDoc']['size'][$index];
                $nuevoDocumento = $this->subeDocumento($file, $orden);
                if(isset($nuevoDocumento)){
                    $documentos[$orden]=$nuevoDocumento;
                }
                $orden++;
            }
        }
        return $documentos;
    }

    protected function subeDocumento($file, $orden) {
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
        $oDocumento = null;
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
                    return $this->saveDocumento($safe_name, $safe_filename, $orden);
                } else {
                    //echo "Posible problemas de permisos: ";
                    // no me importa, la subo sin imagen jeje
                }
            }
        }

        return null;
    }
    

    public function deleteDocumento($documentoId) {
        $oDocumento = $this->manejador->getDocumento($documentoId);
        $this->manejador->eliminarDocumento($oDocumento);
        $this->sendJSONResponseMessage("OK", "");
    }

    public function getDocumentosJSON() {
        $vDocumentos = $this->getDocumentosGuardadas();

        $vResponse = array();
        $idx = 0;
        foreach ($vDocumentos as $documento) {
            $object = new StdClass;
            $object->id = $documento->getId();
            $object->nombre = $documento->getNombre();

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