<?php
require_once dirname(dirname(__FILE__)).'/web/init.php';//accedemos a toda la configuracion de web.

define('TEST_ROOT_DIR', dirname(__FILE__));
define('TEST_ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
define('WEB_ROOT_DIR', dirname(dirname(__FILE__)).'/web');//subimos dos niveles

?>