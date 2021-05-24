<?php

namespace Session;

use Core\Session;

class Message extends Session
{
    public function setErrorMessage($message)
    {
        $this->set('error_message', $message);
    }

    public function getErrorMessage()
    {
        return $this->get('error_message');
    }

    public function unsetErorrMeesage()
    {
        $this->unset('error_message');
    }

    public function setSuccessMessage($message)
    {
        $this->set('success_message', $message);
    }

    public function getSuccessMessage()
    {
        return $this->get('success_message');
    }

    public function unsetSuccessMeesage()
    {
        $this->unset('success_message');
    }
}