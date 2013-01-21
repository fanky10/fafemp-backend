<?php

require_once (TEST_ROOT_DIR . '/simpletest/autorun.php');

class DatabaseIsolatedTestCase extends UnitTestCase {

    private $dataSource;

    public function __construct($label = true) {
        parent::__construct($label);
        $this->dataSource = MysqlDataSource::getInstance();
    }

    //isolate each test (:
    function setUp() {
        $this->dataSource->startTransaction();
    }

    function tearDown() {
        $this->dataSource->rollbackTransaction();
        $this->dataSource->closeConnection();
    }

}

?>
