<?php

include_once '../vendor/autoload.php';
include_once '../config.php';

$db = new \Core\Db();
$db->truncate('user')->exec();
$db->truncate('city')->exec();
$db->truncate('map_field')->exec();
$db->truncate('building')->exec();
$db->truncate('city')->exec();
$db->truncate('user_resource')->exec();
echo "Tables truncated <br>";

$generator = new \Service\Map\Generator();
$generator->execute();
echo "Map Generated <br>";

$user = new \Model\User();
$user->setUserName('Arnoldas');
$user->setEmail('nikaflash@gmail.com');
$user->setPassword('admin123');
$user->save();
echo "User Created <br>";

$assign = new \Service\Map\Field\AssignField();
$mapField = $assign->createAndAssignField($user->getId());
echo "Field Assighned <br>";

$city = new Model\City();
$city->setName('City of '.$user->getUserName());
$city->setMapFieldId($mapField->getId());
$city->save();
echo "City created <br>";

$resoursesIds = [1, 2, 3, 4, 5, 6, 7];

foreach ($resoursesIds as $id){
    $userResource = new Model\UserResource();
    $userResource->setUserId($user->getId());
    $userResource->setValue(500);
    $userResource->setResourceId($id);
    $userResource->save();
}
echo "Resourses assigned <br>";


$building = new \Model\Building();
$building->setBuildinTypeId(1);
$building->setCityId($city->getId());
$building->setLevel(1);
$building->setPosition(1);
$building->save();
echo "Default buildings initiated <br>";

echo 'Install completed!';
