<?php

namespace Model;

use Core\Db;
use Model\ModelAbstract;
use Model\City;

class MapField extends ModelAbstract
{
    public const X_COLUMN = 'x';
    public const Y_COLUMN = 'y';
    public const FIELD_TYPE_COLUMN = 'field_type_id';
    public const USER_ID_COLUMN = 'user_id';
    public const TABLE_NAME = 'map_field';

    private $x;

    private $y;

    private $fieldTypeId;

    private $userId;

    private $city;

    /**
     * @return mixed
     */
    public function getCity()
    {
        $cityObject = new City();
        $this->city = $cityObject->loadByMapFieldId($this->id);
        return $this->city;
    }

    /**
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param integer $x
     */
    public function setX($x): void
    {
        $this->x = $x;
    }

    /**
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param integer $y
     */
    public function setY($y): void
    {
        $this->y = $y;
    }

    /**
     * @return integer
     */
    public function getFieldTypeId()
    {
        return $this->fieldTypeId;
    }

    /**
     * @param integer $fieldTypeId
     */
    public function setFieldTypeId($fieldTypeId): void
    {
        $this->fieldTypeId = $fieldTypeId;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param integer $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public static function getAllFields()
    {
        $db = new Db();
        return $db->select()->from(static::TABLE_NAME)->get();
    }

    public static function isFieldsEmpty($x, $y)
    {
        $db = new Db();

        $result = $db->select()->from(static::TABLE_NAME)
            ->where(self::X_COLUMN, $x)
            ->whereAnd(self::Y_COLUMN, $y)->get();
        // $result = $db->select()->from('map_field')->where('x', $x)->whereAnd('y',$y)->get(); same like ^^^^^

        return empty($result) ? true : false;
    }

    public function load($id)
    {
        $db = new Db;
        $result = $db->select()->from(static::TABLE_NAME)->where(self::ID_COLUMN, $id)->getOne();
        $this->id = $result[self::ID_COLUMN];
        $this->x = $result[self::X_COLUMN];
        $this->y = $result[self::Y_COLUMN];
        $this->fieldTypeId = $result[self::FIELD_TYPE_COLUMN];
        $this->userId = $result[self::USER_ID_COLUMN];
        return $this;
    }

    public function prepeareArray()
    {
        return [
            self::X_COLUMN => $this->x,
            self::Y_COLUMN => $this->y,
            self::FIELD_TYPE_COLUMN => $this->fieldTypeId,
            self::USER_ID_COLUMN => $this->userId,
        ];
    }

    public static function getUserFields($userId)
    {
        $db = new Db();
        $result = $db->select()->from(self::TABLE_NAME)->where(self::USER_ID_COLUMN, $userId)->get();
        return $result;
    }

}