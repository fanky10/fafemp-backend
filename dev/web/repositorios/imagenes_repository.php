<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/imagen.php';

interface ImagenesRepository{
    public function getImagenes();
    public function getImagenesNoticia($noticiaId);
    public function getImagen($id);
    public function addImagenNoticia(Imagen $imagen,$noticiaId);
}
?>
