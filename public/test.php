<?php


include_once '../vendor/autoload.php';
include_once '../config.php';


$mapFieldObject = new \Model\MapField();
$mapField = $mapFieldObject->getFieldName();

echo "<pre>";
print_r($mapField);
