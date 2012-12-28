<?php

interface NoticiasRepository{
    public function getNoticias();
    public function getNoticia($titulo);
    public function addNoticia($noticia);
}
?>
