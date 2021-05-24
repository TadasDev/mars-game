<?php

namespace Helper;

class Url
{
    public static function make($path)
    {
        return BASE_URL.$path;
    }

    public static function redirect($url)
    {
        header('Location: '.$url);
        exit;
    }
}