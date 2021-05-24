<?php

namespace Service\Map;

use Helper\Url;
use Model\MapField;
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
        $sortedFields = [];
        foreach($fields as $field){
            $sortedFields[$field['y']][$field['x']] = $field;
            $sortedFields[$field['y']][$field['x']]['class'] = $this->fieldClasses[$field[MapField::FIELD_TYPE_COLUMN]];
            $sortedFields[$field['y']][$field['x']]['link'] = $this->getLink($field);

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