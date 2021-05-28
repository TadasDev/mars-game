<?php

namespace Controller;

use Core\Controller;
use Helper\Url;
use Model\MapField;
use Service\Game\CityBuildings;
use Service\Map\Loader;

class Map extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->isLogedIn()){
            Url::redirect(Url::make('/user/login'));
        }
    }

    public function index()
    {
        $map = new Loader();

        $this->data['fields'] = $map->get();
        $userSession = new \Session\User();
        $this->data['user_id'] = $userSession->getAuthUserId();
        $this->render('game/map', $this->data);
    }

    public function city($id)
    {
        $city = new \Model\City();
        $field = new MapField();
        $field->load($id);


        $city->loadByMapFieldId($id);
        $this->data['city'] = $city;
        if($field->getUserId() === $this->userSession->getAuthUserId()){
            $this->data['buildings'] = CityBuildings::prepeare($city);
            $this->render('game/city', $this->data);
        }else{
            $this->render('game/enemy_city', $this->data);
        }

    }
}