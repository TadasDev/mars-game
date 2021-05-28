<?php

namespace Model;

use Model\ModelAbstract;
use Core\Db;
use Model\MapField;
use Model\UserResource;

class User extends ModelAbstract
{
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';
    public const TABLE_NAME = 'user';


    private $userName;
    private $password;
    private $email;

    private $fields = [];

    /**
     * @return mixed
     */
    public function getFields()
    {
        $fields = MapField::getUserFields($this->id);
        if(!empty($fields)){
            foreach ($fields as $field){
                $fieldObject = new MapField();
                $fieldObject->load($field['id']);
                $this->fields[] = $fieldObject;
            }
        }

        return $this->fields;
    }



    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($name)
    {
        $this->userName = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function load($id)
    {
        $db = new Db();
        $user = $db->select()->from(DB::USER_TABLE)->where(self::ID_COLUMN, $id)->getOne();
        $this->id = $user[self::ID_COLUMN];
        $this->userName = $user[self::NAME_COLUMN];
        $this->email = $user[self::EMAIL_COLUMN];
        $this->password = $user[self::PASSWORD_COLUMN];

        return $this;


    }

    public function loadByEmail($email)
    {
        $db = new Db();
        $user = $db->select()->from(self::TABLE_NAME)->where(self::EMAIL_COLUMN, $email)->getOne();
        $this->load($user['id']);

        return $this;
    }


    public static function isValidLoginCredentionals($email, $password)
    {
        $db = new Db();
        $result = $db->select()
            ->from(self::TABLE_NAME)
            ->where(self::EMAIL_COLUMN, $email)
            ->whereAnd(self::PASSWORD_COLUMN, $password)
            ->get();
        if (!empty($result)) {
            return true;
        }

        return false;
    }

    public static function isEmailUnic($email)
    {
        $db = new Db();
        $result = $db->select()->from(self::TABLE_NAME)->where(self::EMAIL_COLUMN, $email)->get();
        return empty($result) ? true : false;
    }

    public function prepeareArray()
    {
        return [
            self::NAME_COLUMN => $this->userName,
            self::PASSWORD_COLUMN => $this->password,
            self::EMAIL_COLUMN => $this->email
        ];
    }

    public static function getAllUsers()
    {
        $db = new Db();
        $result = $db->select()->from(self::TABLE_NAME)->get();
        return $result;
    }

    public function getResources()
    {
        $resources = [];
        $userResourses = new UserResource();
        $resoursesArray =  $userResourses->loadUserResourses($this->id);
        foreach ($resoursesArray as $resource){
            $resourceObject = new UserResource();
            $resources[] = $resourceObject->load($resource['id']);
        }

        return $resources;
    }


}