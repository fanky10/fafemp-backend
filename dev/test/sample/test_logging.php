<?php

require_once ('../initTesting.php');
require_once (ROOT_DIR . '/simpletest/autorun.php');
require_once ('log.php');

class TestOfLogging extends UnitTestCase {
    function __construct() {
        parent::__construct('Log test');
    }

    function testFirstLogMessagesCreatesFileIfNonexistent() {
        $logDir = ROOT_DIR.'/temp/test.log';
        @unlink($logDir);
        $log = new Log($logDir);
        $log->message('Should write this to a file');
        $this->assertTrue(file_exists($logDir));
    }

}

?>
