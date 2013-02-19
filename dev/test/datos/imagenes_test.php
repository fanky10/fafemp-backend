<?php

require_once ('../initTesting.php');
require_once (WEB_ROOT_DIR . '/datos/imagenes.php');
require_once (WEB_ROOT_DIR . '/datos/noticias.php');
require_once (WEB_ROOT_DIR . '/datos/reuniones.php');
require_once (WEB_ROOT_DIR . '/datos/data.php');
require_once (WEB_ROOT_DIR . '/entidades/imagen.php');
require_once (WEB_ROOT_DIR . '/entidades/noticia.php');
require_once (WEB_ROOT_DIR . '/entidades/reunion.php');
require_once ('db_isolated_test_case.php');

class ImagenesTest extends DatabaseIsolatedTestCase {

    private $imagenesRepository;
    private $noticiasRepository;
    private $reunionesRepository;

    public function __construct() {
        parent::__construct("Imagenes Test");
        $this->imagenesRepository = new DataImagenes();
        $this->noticiasRepository = new DataNoticias();
        $this->reunionesRepository = new DataReuniones();
    }

    function testAddImageNoticia() {
        $idNoticia = $this->agregaNoticia();
        $idImagen = $this->agregaImagenNoticia($idNoticia);
        $this->assertTrue(isset($idImagen));
    }

    function testGetImagenesNoticia() {
        $idNoticia = $this->agregaNoticia();
        $i = 0;
        while ($i < 4) {
            $this->agregaImagenNoticia($idNoticia);
            $i++;
        }
        $imagenes = $this->imagenesRepository->getImagenesNoticia($idNoticia);
        $this->assertTrue(isset($imagenes) && count($imagenes) == 4);
    }

    function testGetImagenByID() {
        $idNoticia = $this->agregaNoticia();
        $idImagen = $this->agregaImagenNoticia($idNoticia);
        
        $oImagen = $this->imagenesRepository->getImagen($idImagen);
        $this->assertTrue(isset($oImagen));
    }

    function testEditImagen() {
        $idNoticia = $this->agregaNoticia();
        $idImagen = $this->agregaImagenNoticia($idNoticia);

        $imagen = new Imagen();
        $editedImagen = new Imagen();

        $imagen->setNombre("pepe2.png");
        $imagen->setNombreArchivo("pepe2.png");
        $imagen->setPath("/pepe/2");
        $imagen->setId($idImagen);

        $this->imagenesRepository->editarImagenNoticia($imagen);

        $editedImagen = $this->imagenesRepository->getImagen($idImagen);
        $this->assertTrue(isset($editedImagen) && $this->isEquals($imagen, $editedImagen));
    }

    private function agregaImagenNoticia($idNoticia) {
        $imagen = new Imagen();
        $imagen->setNombre("pepe.png");
        $imagen->setNombreArchivo("pepe.png");
        $imagen->setPath("/pepe/");
        $imagen->setOrden(1);

        return $this->imagenesRepository->addImagenNoticia($imagen, $idNoticia);
    }

    private function agregaNoticia() {
        $noticia = new Noticia();
        $noticia->setCuerpo("Noticia con imagen!");
        $noticia->setTitulo("una noticia con imagen");

        return $this->noticiasRepository->addNoticia($noticia);
    }
    
    function testAddImageReunion() {
        $idReunion = $this->agregaReunion();
        $idImagen = $this->agregaImagenReunion($idReunion);
        $this->assertTrue(isset($idImagen));
    }

    function testGetImagenesReunion() {
        $idReunion = $this->agregaReunion();
        $i = 0;
        while ($i < 4) {
            $this->agregaImagenReunion($idReunion);
            $i++;
        }
        $imagenes = $this->imagenesRepository->getImagenesReunion($idReunion);
        $this->assertTrue(isset($imagenes) && count($imagenes) == 4);
    }
    
    private function agregaReunion(){
        $reunion = new Reunion();
        
        $reunion->setCuerpo("Esto es un cuerpo");
        $reunion->setTitulo("re title!");
        
        // esto lo convierte a un mysql directamente.
        // esto es lo mas parecido que va a hacer el controlador.
        // a partir de una fecha ingresada a mano, se formatea a mysql que es mas generico
        $phpDateTime = DateTime::createFromFormat('d/m/Y','25/05/2013');
        $mysqldate = $phpDateTime->format('Y-m-d H:i:s');
        $reunion->setFechaInicio($mysqldate);
        $reunion->setFechaFin($mysqldate);

        return $this->reunionesRepository->addReunion($reunion);
    }
    private function agregaImagenReunion($idReunion) {
        $imagen = new Imagen();
        $imagen->setNombre("pepe.png");
        $imagen->setNombreArchivo("pepe.png");
        $imagen->setPath("/pepe/");
        $imagen->setOrden(1);

        return $this->imagenesRepository->addImagenReunion($imagen, $idReunion);
    }

    private function isEquals(Imagen $imagen, Imagen $otherImagen) {
        return ($imagen->getNombre() == $otherImagen->getNombre() &&
                $imagen->getNombreArchivo() == $otherImagen->getNombreArchivo() &&
                $imagen->getPath() == $otherImagen->getPath() );
    }

}

?>
