<?php

namespace Service\Map\Field;

use Model\MapField;
use Service\Map\Generator;
use Model\City;

class AssignField
{
    public function createAndAssignField($userId)
    {
        $cordinations = $this->getEmptyField();
        $x = $cordinations['x'];
        $y = $cordinations['y'];
        $mapField = new MapField();
        $mapField->setX($x);
        $mapField->setY($y);
        $mapField->setUserId($userId);
        $mapField->setFieldTypeId(Generator::CITY_FIELD);
        $mapField->save();
        return $mapField;
    }

    public function getEmptyField()
    {
        $x = rand(1, Generator::MAX_LENGHT);
        $y = rand(1, Generator::MAX_HEIGHT);

        if (MapField::isFieldsEmpty($x, $y)) {
            return ['x' => $x, 'y' => $y];
        } else {
            return $this->getEmptyField();
        }
    }

}