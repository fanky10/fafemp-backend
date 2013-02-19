<?php

include_once '../init.php';
include_once ROOT_DIR . '/entidades/reuinion.php';

interface ReunionesRepository{
    public function getReuniones($limit);
    public function getReunionById($id);
    public function addReunion(Reunion $reunion);
    public function editarReunion(Reunion $reunion);
}
?>
