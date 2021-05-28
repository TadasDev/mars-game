<?php

namespace Controller;

use Core\Controller;
use Model\Duk;

class ControllerDuk extends Controller
{
    public function index()
    {
        if ($this->isLogedIn()) {

            $duk = new Duk();
            $dukDb = $duk->getDuk();

            $this->data['duk'] = $dukDb;
            $this->render('/user/duk', $this->data);
        }
    }
}

