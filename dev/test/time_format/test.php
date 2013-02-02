<?php
echo "q ase";
header('Content-Type: text/html; charset=UTF-8');

$GLOBAL_SETTINGS = parse_ini_file("settings.ini");
ini_set('display_errors', $GLOBAL_SETTINGS['errors.display']);
ini_set('date.timezone', $GLOBAL_SETTINGS['date.timezone']);
//setlocale(LC_ALL,"es_ES.UTF-8");
setlocale(LC_ALL,"es_ES");

$timestamp = time();
$formatter = $GLOBAL_SETTINGS['news.date.formatter'];
$stringedTime = strftime($formatter, $timestamp);
$formattedDate = iconv('ISO-8859-1', 'UTF-8', $stringedTime);
$utfEncoded = utf8_encode($stringedTime);
setlocale(LC_ALL,"es_ES");
echo("formatter: $formatter -- stringed: $stringedTime -- utf-parse: $formattedDate -- utf-encoded: $utfEncoded");
?>