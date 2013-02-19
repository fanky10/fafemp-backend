<?php

$phpdate = time();
echo 'phpDate before ' . $phpdate;
echo '<br/>';
$mysqldate = date('Y-m-d H:i:s', $phpdate);
echo 'mysqlDate then ' . $mysqldate;
echo '<br/>';
$phpdate = strtotime($mysqldate);
echo 'phpDate then ' . $phpdate;
echo '<br/>';
?>
