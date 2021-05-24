<?php

namespace Helper\Validation;

use Model\User;
use Session\Message;

class InputValidation
{
    private $message;

    public function __construct()
    {

    }
    public const MIN_PASSWORD_LENGHT = 6;

    public static function isEmailValid($email)
    {
        if (User::isEmailUnic($email) && self::isEmail($email)) {
            return true;
        }
        $message = new Message();
        $message->setErrorMessage('Email already in use.');
        return false;
    }

    public static function isEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            $message = new Message();
            $message->setErrorMessage('not valid email.');
            return false;
        }
    }

    public static function isPasswordValid($pass, $pass2)
    {
        if (self::passwordsMatch($pass, $pass2) && self::isStrong($pass)) {
            return true;
        }
        $message = new Message();
        $message->setErrorMessage('Password didn\'t match or it not strong enought');
        return false;
    }

    public static function passwordsMatch($pass, $pass2)
    {
        return $pass === $pass2;
    }

    public static function isStrong($pass)
    {
        return strlen($pass) >= self::MIN_PASSWORD_LENGHT;
    }
}