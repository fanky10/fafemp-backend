<?php

$jsonReceived = $_POST['jsonObject'];
$items = json_decode($jsonReceived);

echo" each item: <br/>";
foreach ($items as $item) {
    foreach ($item as $property => $value) {
        print($property . ' = ' . $value . ' , ');
    }
    echo"<br/>";
}
?>
