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

    protected $connection;

    public function __construct() {
        //para que este dentro del standar :)
        $this->connection = $this->initDB();
    }

    /*
     * DB Initialization method.
     * Returns the connection variable.
     * ver de hacerla singleton o algo asi para no consumir tantos recursos y evitar uso indebido
     */
    protected function initDB() {
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

        $connection = mysql_connect($databaseURL, $databaseUName, $databasePWord)
                or die("Error while connecting to host <br/> error: " . mysql_error());
        mysql_query('SET NAMES utf8');
        $db = mysql_select_db($databaseName, $connection)
                or die("Error while connecting to database <br/> error: " . mysql_error());
        return $connection;
    }

    /*
      DB Closing method.
      Pass the connection variable
      obtained through initDB().
     */

    public function closeDB() {
        mysql_close($this->connection);
    }
    public function getUltimoID($tabla,$column){
        $query = "select max($column) as ultimo_id from $tabla";
        $result = mysql_query($query)
            or die ("Query Failed ".mysql_error());
        $id = -1;
        while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
            $id = $row['ultimo_id'];
        }
        return $id;
    }
}

?>