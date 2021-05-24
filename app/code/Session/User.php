<?php

namespace Session;

use Core\Session;

class User extends Session
{

    public function createUserSession($user)
    {
        $this->set('loged', true);
        $this->set('user', $user);
        $this->set('user_id', $user->getId());
    }

    public function isLoged()
    {
        return $this->get('loged');
    }

    public function getAuthUser()
    {
        return $this->get('user');
    }

    public function getAuthUserId()
    {
        return $this->get('user_id');
    }
}