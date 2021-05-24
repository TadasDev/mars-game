<?php

namespace Model;

class Contact extends ModelAbstract
{
    private $email;
    private $message;

    public const TABLE_NAME = 'CONTACT';
    public const EMAIL_COLUMN = 'email';
    public const MESSAGE_COLUYMN = 'message';
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMeesage()
    {
        return $this->message;
    }

    /**
     * @param mixed $meesage
     */
    public function setMeesage($message): void
    {
        $this->message = $message;
    }


    public function prepeareArray()
    {
        return [
            self::EMAIL_COLUMN => $this->email,
            self::MESSAGE_COLUYMN => $this->message
        ];
    }
}