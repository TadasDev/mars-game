<?php

namespace Controller;

use Core\Controller;
use Core\Request;
use Helper\FormBuilder;
use Helper\Url;
use Model\Building;
use Session\User;
use Model\User as UserModel;
use Service\Game\Construction;

class City extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->isLogedIn()) {
            Url::redirect(Url::make('/user/login'));
        }
    }

    public function index()
    {
        $userSession = new User();
        $user = $userSession->getAuthUser();
        $userModel = new UserModel();
        $user = $userModel->load($userSession->getAuthUserId());

        $this->data['user'] = $user;
        $this->render('game/city', $this->data);
    }

    public function build($id)
    {
        $position = $_GET['position'];
        $form = new FormBuilder('post', Url::make('/city/construct'));
        $options = [
            1 => 'main',
            2 => 'garden',
            3 => 'warehouse',
            4 => 'research_center',
            5 => 'baracks',
            6 => 'house',
            7 => 'dome',
            8 => 'Glass_factory',
            9 => 'power plant'
        ];
        $form->select('building', $options);
        $form->input('position', 'hidden', $position);
        $form->input('city_id', 'hidden', $id);
        $form->input('submit', 'submit', 'Start constructions');
        $this->data['form'] = $form->get();

        $this->render('/game/city/build', $this->data);
    }

    public function construct()
    {
        $request = new Request();
        $building = new Building();
        $construction = new Construction();

        $position = (int)$request->getPost('position');
        $buildingTypeId = (int)$request->getPost('building');
        $cityId = (int)$request->getPost('city_id');

        $construction->build(1, $position, $buildingTypeId, $cityId);
        Url::redirect(Url::make('/map'));

    }
}