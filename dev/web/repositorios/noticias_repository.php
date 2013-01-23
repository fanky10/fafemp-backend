<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';

interface NoticiasRepository{
    public function getNoticias($limit);
    public function getNoticia($titulo);
    public function getNoticiaById($id);
    public function addNoticia(Noticia $noticia);
    public function getNoticiasPaginadas($offset,$limit);
    public function getCantidadNoticias();
    public function editarNoticia(Noticia $noticia);
}
?>
