<?php

class Configuracion {

    private $databaseURL;
    private $databaseUName;
    private $databasePWord;
    private $databaseName;

    public function __construct() {
        $this->databaseURL = "localhost";
        $this->databaseUName = "fafemp_root";
        $this->databasePWord = "root";
        $this->databaseName = "fafemp_web";
    }

    function get_databaseURL() {
        return $this->databaseURL;
    }

    function get_databaseUName() {
        return $this->databaseUName;
    }

    function get_databasePWord() {
        return $this->databasePWord;
    }

    function get_databaseName() {
        return $this->databaseName;
    }

}

?>