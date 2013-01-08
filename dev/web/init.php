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
ini_set('date.timezone', $GLOBAL_SETTINGS['date.timezone']);
setlocale(LC_ALL,"es_ES");

?>