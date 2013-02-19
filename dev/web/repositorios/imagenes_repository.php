<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/imagen.php';

interface ImagenesRepository{
    public function getImagen($id);
    public function getImagenes();
    public function editarImagen(Imagen $imagen);
    
    public function editarImagenNoticia(Imagen $imagen);
    public function getImagenesNoticia($noticiaId);
    public function addImagenNoticia(Imagen $imagen,$noticiaId);
    
    public function getImagenesReunion($reunionId);
    public function addImagenReunion(Imagen $imagen,$reunionId);
    public function editarImagenReunion(Imagen $imagen);
}
?>
