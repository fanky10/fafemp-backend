<?php

/**
 * aca se definen todas las variables globales
 * hardcodeadas, para usar estas, se debe incluir este archivo :P
 */
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
define('USER_LOGIN', ROOT_URL . "/admin/user_login.php");


$GLOBAL_SETTINGS = parse_ini_file("settings.ini");
ini_set('display_errors', $GLOBAL_SETTINGS['errors.display']);

/**
 * algunas configuraciones globales tambien :P
 * como el exception handler
 */
function myException($exception) {
    echo "<b>Exception:</b> ", $exception->getMessage();
}

set_exception_handler('myException');
//throwing some exception for example :D
//throw new Exception('Damn something happened!');
?>