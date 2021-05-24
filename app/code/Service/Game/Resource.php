<?php

namespace Service\Game;

use Session\User as UserSession;
use Model\UserResource;

class Resource
{
    public const SAND = 1;
    public const CLAY = 2;
    public const METAL = 3;
    public const WATER = 4;
    public const GlASS = 5;
    public const FOOD = 6;
    public const ENERGY = 7;

//    private $resoursesByID  = [
//        1 => 'sand',
//        2 => 'clay',
//        3 => 'metal',
//        4 => 'water',
//        5 => 'glass',
//        6 => 'food',
//        7 => 'energy'
//    ];

    public function getUserResources()
    {
        $session = new UserSession();
        $userResoursesModel = new UserResource();
        $resources = $userResoursesModel->loadUserResourses($session->getAuthUserId());
        return $this->prepareResourseArray($resources);
    }

    private function prepareResourseArray($resources)
    {
        $cleanResourceArray = [];
        foreach($resources as $resource){
//            $cleanResourceArray[$this->resoursesByID[$resource['resource_id']]] = $resource['value'];
            $cleanResourceArray[$resource['name']] = $resource['value'];
        }
        return $cleanResourceArray;
    }


}