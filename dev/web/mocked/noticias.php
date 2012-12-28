<?php

include_once '../init.php';
include_once ROOT_DIR . '/repositorios/noticias_repository.php';
include_once ROOT_DIR . '/entidades/noticia.php';

/**
 * Description of zonas
 *
 * @author fanky
 */
class MockedNoticias implements NoticiasRepository {

    public function getNoticias($limit){
        $noticia_idx = 0;
        $vNews;
        $oNoticia = new Noticia();
        $oNoticia->setCuerpo("un cuerpo re loco 1");
        $oNoticia->setFechaHora("2012-12-12");
        $oNoticia->setId("1");
        //TODO: imagen / url
        $oNoticia->setTitulo("titulo 1");

        $vNews[$noticia_idx] = $oNoticia;
        $noticia_idx = $noticia_idx + 1;
        
        $oNoticia = new Noticia();
        $oNoticia->setCuerpo("un cuerpo re loco 2");
        $oNoticia->setFechaHora("2012-12-12");
        $oNoticia->setId("2");
        //TODO: imagen / url
        $oNoticia->setTitulo("titulo 2");

        $vNews[$noticia_idx] = $oNoticia;
        $noticia_idx = $noticia_idx + 1;
        return $vNews;
        
    }
    public function getNoticia($titulo){
        return null;
        
    }
    public function addNoticia(Noticia $noticia){
        // do nothing
        
    }
}
?>

