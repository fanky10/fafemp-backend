<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/imagen.php';

interface ImagenesRepository{
    public function getImagenes();
    public function getImagen($id);
    public function addImagen(Imagen $imagen);
}
?>
