<?php

namespace Service\Map;

use Helper\Url;
use Model\City;
use Model\MapField;
use Model\User;
use Service\Map\Generator;

class Loader
{
    private $fieldClasses = [];

    public function __construct()
    {
        $this->setFieldClasses();
    }

    public function get()
    {
        $fields = MapField::getAllFields();
        return $this->generate($fields);
    }

    public function generate($fields)
    {
        $user = new User();
        $sortedFields = [];
        foreach($fields as $field){
            $sortedFields[$field['y']][$field['x']] = $field;
            $sortedFields[$field['y']][$field['x']]['class'] = $this->fieldClasses[$field[MapField::FIELD_TYPE_COLUMN]];
            $sortedFields[$field['y']][$field['x']]['link'] = $this->getLink($field);
            if($field['user_id'] !== null){
                $sortedFields[$field['y']][$field['x']]['owner'] = $user->load($field['user_id']);
            }
            if($sortedFields[$field['y']][$field['x']]['class'] !== 'city'){
                $sortedFields[$field['y']][$field['x']]['field_name'] = $sortedFields[$field['y']][$field['x']]['class'];
            }else{
                $city = new City();
                $city->loadByMapFieldId($field['id']);
                $sortedFields[$field['y']][$field['x']]['field_name'] = $city->getName();
            }
        }

        return $sortedFields;
    }

    public function setFieldClasses()
    {
        $this->fieldClasses = [
            Generator::CITY_FIELD => 'city',
            Generator::SAND_FIELD => 'sand',
            Generator::METAL_FIELD => 'metal',
            Generator::CLAY_FIELD => 'clay',
            Generator::WATER_FIELD => 'water',
        ];
    }

    public function getLink($field)
    {
        $url = Url::make('/map/'.$this->fieldClasses[$field[MapField::FIELD_TYPE_COLUMN]].'/'.$field['id']);
        return $url;
    }

}