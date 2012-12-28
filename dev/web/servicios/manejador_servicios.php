<?php
@include_once 'init.php';
@include_once ROOT_DIR .'/mocked/noticias.php';
class ManejadorServicios{
    private $noticiasRepository;
    public function __construct() {
        $this->noticiasRepository = new MockedNoticias();
    }
    
    public function getNoticias(){
        return $this->noticiasRepository->getNoticias();
    }
}
?>
