<?php

/**
 * Description of Data
 * ver como se va a manejar si hacer el initDB en la contruccion
 * y el closeDB publico con un finally
 * obviamente la conexion va a ser un atributo protegido por Data
 *
 * @author fanky
 *
 */
@include_once '../init.php';
@include_once ROOT_DIR . '/conf/conf.php';

class Data {

    protected $mysqli;

    public function __construct() {
        //para que este dentro del standar :)
        $this->mysqli = $this->initMysqlDB();
    }

    protected function initMysqlDB() {
        //setea en la session la database
        if (!isset($_SESSION['databaseURL'])) {
            $dbConf = new Configuracion();
            $databaseURL = $dbConf->get_databaseURL();
            $databaseUName = $dbConf->get_databaseUName();
            $databasePWord = $dbConf->get_databasePWord();
            $databaseName = $dbConf->get_databaseName();

            //Set DB Info. in-session
            $_SESSION['databaseURL'] = $databaseURL;
            $_SESSION['databaseUName'] = $databaseUName;
            $_SESSION['databasePWord'] = $databasePWord;
            $_SESSION['databaseName'] = $databaseName;
        }
        $databaseURL = $_SESSION['databaseURL'];
        $databaseUName = $_SESSION['databaseUName'];
        $databasePWord = $_SESSION['databasePWord'];
        $databaseName = $_SESSION['databaseName'];
        $mysqli = new mysqli($databaseURL, $databaseUName, $databasePWord, $databaseName);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        return $mysqli;
    }

    /*
      DB Closing method.
      Pass the connection variable
      obtained through initDB().
     */

    public function closeDB() {
        mysqli_close($this->mysqli);
    }

    protected function prepareStmt($query) {
        return $this->mysqli->prepare($query);
    }

    public function getUltimoID($tabla, $column) {
        $query = "select max($column) as ultimo_id from $tabla";
        $result = $this->mysqli->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$this->mysqli->errno}] {$this->mysqli->error}");
        }
        $row = $result->fetch_assoc();
        $id = $row['ultimo_id'];
        return $id;
    }

}

?>