<?php

namespace Controller;

use Core\Controller;
use Helper\FormBuilder;
use Helper\Url;
use Model\City;
use Model\MapField;
use Model\User as UserModel;
use Model\Collection\Users;
use Core\Request;
use Helper\Validation\InputValidation as Validation;
use Service\Map\Field\AssignField;
use Service\Game\InitUserInGame;

use Model\UserResource;

class User extends Controller
{
    public function index()
    {
        echo 'user index';
    }

    public function registration()
    {
        if (!$this->userSession->isLoged()) {
            $form = new FormBuilder('post', Url::make('/user/create'));
            $form->input('name', 'text', '', 'Username');
            $form->input('email', 'email', '', 'Email');
            $form->input('password', 'password', '', '******');
            $form->input('password2', 'password', '', '******');
            $form->input('register', 'submit', 'Register');
            $this->data['form'] = $form->get();
            $this->render('user/register', $this->data);
        } else {
            Url::redirect(Url::make('/map'));
        }
    }

    public function login()
    {
        if (!$this->userSession->isLoged()) {
            $form = new FormBuilder('post', Url::make('/user/check'));
            $form->input('email', 'email', '', 'Email');
            $form->input('password', 'password', '', '******');
            $form->input('login', 'submit', 'Login');
            $this->data['form'] = $form->get();
            $this->render('user/login', $this->data);
        } else {
            Url::redirect(Url::make('/map'));
        }
    }


    public function create()
    {
        $request = new Request();
        $user = new UserModel();
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $password2 = $request->getPost('password2');

        if (
            !Validation::isEmailValid($email) &&
            !Validation::isPasswordValid($password, $password2)
        ) {
            Url::redirect(Url::make('/user/registration'));
        }

        $user->setUserName($request->getPost('name'));
        $user->setEmail($email);
        $user->setPassword($password);
        $user->save();

        $init = new InitUserInGame();
        $init->createUsersDefaults($user->getId());

        $this->message->setSuccessMessage('Account created');

        Url::redirect(Url::make('/user/login'));
    }

    public function check()
    {
        $reques = new Request();
        $email = $reques->getPost('email');
        $password = $reques->getPost('password');
        if (UserModel::isValidLoginCredentionals($email, $password)) {
            $user = new UserModel();
            $user->loadByEmail($email);
            $this->userSession->createUserSession($user);
            Url::redirect(Url::make('/map'));
        } else {
            $this->message->setErrorMessage('Email or Password not match');
            Url::redirect(Url::make('/user/login'));
        }
    }

    public function logout()
    {
        session_destroy();
        Url::redirect(Url::make('/user/login'));
    }

    public function edit()
    {
        if ($this->userSession->isLoged()) {
            $user = new UserModel();
            $user->load($this->userSession->getAuthUserId());
            $form = new FormBuilder('post', Url::make('/user/update'));
            $form->input('name', 'text', $user->getUserName())
                ->input('email', 'email', $user->getEmail())
                ->input('password', 'password', '', 'New Password')
                ->input('password2', 'password', '', 'Repeat new Password')
                ->input('save', 'submit', 'Save');
            $this->data['form'] = $form->get();
            $this->render('user/update', $this->data);
        } else {
            Url::redirect(Url::make('/user/login'));
        }
    }

    public function update()
    {
        $request = new Request();

        $user = new UserModel();
        $user->load($this->userSession->getAuthUserId());
        $user->setUserName($request->getPost('name'));
        $user->setEmail($request->getPost('email'));
        if ($request->getPost('password')) {
            $user->setPassword($request->getPost('password'));
        }

        $user->save();
        Url::redirect(Url::make('/user/edit/'));
    }

    public function stats()
    {
        $usersCollection = new Users();
        $users = $usersCollection->getCollection();
        $this->data['users'] = $users;
        $this->render('user/list', $this->data);
    }

    public function view($id)
    {
        $user = new UserModel();
        $user->load($id);
        $this->data['user'] = $user;
        $this->render('user/view', $this->data);
    }


}

