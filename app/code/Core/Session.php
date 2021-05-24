<?php

namespace Core;

class Session
{
    public function set($key,$value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }

        return false;
    }

    public function unset($key)
    {
       unset($_SESSION[$key]);
    }
}
