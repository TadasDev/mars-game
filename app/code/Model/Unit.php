<?php

namespace Model;

use Core\Db;

class Unit extends ModelAbstract
{
    public const TABLE_NAME = 'user_unit';
    public const UNIT_ID_COLUMN = 'unit_id';
    public const CITY_ID_COLUMN = 'city_id';
    public const VALUE_COLUMN = 'value';

    private $unitId;
    private $cityId;
    private $value;

    /**
     * @return mixed
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * @param mixed $unitId
     */
    public function setUnitId($unitId): void
    {
        $this->unitId = $unitId;
    }

    /**
     * @return mixed
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * @param mixed $cityId
     */
    public function setCityId($cityId): void
    {
        $this->cityId = $cityId;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function prepeareArray()
    {
        return [
            self::UNIT_ID_COLUMN => $this->unitId,
            self::CITY_ID_COLUMN => $this->cityId,
            self::VALUE_COLUMN => $this->value
        ];
    }

    public static function getUserUnitsIds($cityId)
    {
        $db = new Db();
        $result = $db
            ->select('id')
            ->from(self::TABLE_NAME)
            ->where(self::CITY_ID_COLUMN, $cityId)
            ->exec();
        return $result;
    }
}