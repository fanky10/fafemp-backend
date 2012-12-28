<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/noticia.php';

interface NoticiasRepository{
    public function getNoticias();
    public function getNoticia($titulo);
    public function addNoticia(Noticia $noticia);
}
?>
