<?php

namespace Controller;

use Core\Controller;
use Helper\Url;
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
        $this->render('game/map', $this->data);
    }

    public function city($id)
    {
        $city = new \Model\City();
        $city->loadByMapFieldId($id);
        $this->data['city'] = $city;
        $this->data['buildings'] = CityBuildings::prepeare($city);
        $this->render('game/city', $this->data);
    }
}