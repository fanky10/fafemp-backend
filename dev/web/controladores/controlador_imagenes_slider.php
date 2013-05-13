<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';
include_once ROOT_DIR . '/entidades/imagen.php';
include_once ROOT_DIR . '/servicios/manejador_servicios.php';
include_once ROOT_DIR . '/util/utilidades.php';
include_once 'controlador_imagenes.php';

class ControladorImagenesSlider extends ControladorImagenes {

    private $oImagen;

    public function __construct($dirBase, $imgPath) {
        parent::__construct($dirBase, $imgPath);
        $this->oImagen = new Imagen();
    }

    public function saveSlider($idImagen, $idNoticia, $width, $height, $xPosition, $yPosition, $wValue, $hValue) {
        $jpeg_quality = 90;

        $this->oImagen = $this->manejador->getImagen($idImagen);
        if (isset($this->oImagen)) {
            try{
            //la imagen original que estamos por resizear
            $src = $this->dirBase . $this->oImagen->getPath() . "/" . $this->oImagen->getNombreArchivo();
            $ext = pathinfo($this->oImagen->getNombreArchivo(), PATHINFO_EXTENSION);
            $nombreArchivo = Utilidades::safeText($idNoticia . '-Slider.' . $ext);
            $outputFilename = $this->dirBase . $this->imgPath . "/" . $nombreArchivo;
            $img_r = imagecreatefromjpeg($src);
            $dst_r = imagecreatetruecolor($width, $height);

            imagecopyresampled($dst_r, $img_r, 0, 0, $xPosition, $yPosition, $width, $height, $wValue, $hValue);
            //why two times?
//            imagejpeg($dst_r, time() . '.jpg', $jpeg_quality);

            imagejpeg($dst_r, $outputFilename, $jpeg_quality);

            //if everyhing went as expected:
            $this->setSliderNoticia($this->oImagen->getNombre(), $nombreArchivo, $idNoticia);
            }  catch (Exception $exception){
                echo 'la imagen no se pudo editar ';
                exit;
            }
        }
    }

    private function setSliderNoticia($nombreImagen, $nombreArchivo, $idNoticia) {
        $imagen = new Imagen();
        $imagen->setNombre($nombreImagen);
        $imagen->setNombreArchivo($nombreArchivo);
        $imagen->setPath($this->imgPath);
        $imagen->setOrden(1);

        $imagenId = $this->manejador->addImagen($imagen);
        $this->manejador->setImgSliderNoticia($idNoticia, $imagenId);
    }

    protected function getImagenesGuardadas() {
        return null; //I dont care
    }

    protected function saveImage($safe_name, $safe_filename, $orden) {
        return null; //I dont care
    }

}

?>
