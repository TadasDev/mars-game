<?php

namespace Service\Game;

use Model\City;
use Model\User;
use Model\UserResource;
use Model\Building;

use Service\Map\Field\AssignField;

class InitUserInGame
{
    public function createUsersDefaults($userId)
    {
        $assign = new AssignField();
        $mapField = $assign->createAndAssignField($userId);

        $user = new User();
        $user->load($userId);
        $city = new City();
        $city->setName('City of ' . $user->getUserName());
        $city->setMapFieldId($mapField->getId());
        $city->save();
        $resoursesIds = [1, 2, 3, 4, 5, 6, 7];

        foreach ($resoursesIds as $id) {
            $userResource = new UserResource();
            $userResource->setUserId($user->getId());
            $userResource->setValue(500);
            $userResource->setResourceId($id);
            $userResource->save();
        }

        $building = new Building();
        $building->setBuildinTypeId(1);
        $building->setCityId($city->getId());
        $building->setLevel(1);
        $building->setPosition(1);
        $building->save();

    }


}