<?php

include_once 'json_object.php';
$vResponse = array();
$jsonObject = new JSONObject(1,"pepe");
$vResponse[0] = $jsonObject->toJson();
$jsonObject = new JSONObject(2,"pepe2");
$vResponse[1] = $jsonObject->toJson();
$jsonObject = new JSONObject(3,"pepe3");
$vResponse[2] = $jsonObject->toJson();
// PRINT JSON FILE
header("Content-type: application/json");
echo json_encode($vResponse);

//this works!
//$jsonObject = new JSONObject(1,"pepe");
//$jsonResponse = $jsonObject->toJson();
//echo $jsonResponse;
?>
