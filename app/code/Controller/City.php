<?php

namespace Controller;

use Core\Controller;
use Helper\Url;
use Session\User;
use Model\User as UserModel;
class City extends Controller
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
        $userSession = new User();
        $user = $userSession->getAuthUser();
        $userModel = new UserModel();
        $user = $userModel->load($userSession->getAuthUserId());

        $this->data['user'] = $user;
        $this->render('game/city', $this->data);
    }

    public function build($id){
        $position = $_GET['position'];

        $this->render('game/city/build', $this->data);
    }
}