<?php

namespace Service\Game;

class CityBuildings
{
    public static function prepeare(\Model\City $city)
    {
        $buildigs = $city->getBuildings();
        $cityArray = self::getEmptyCityGrid();
        foreach ($buildigs as $building){
            $cityArray[$building->getPosition()] = $building;
        }

        return $cityArray;
    }

    public static function getEmptyCityGrid()
    {   $array = [];

        for ($i = 1; $i <= 16; $i++) {
            $array[$i] = '';
        }

        return $array;
    }

}
