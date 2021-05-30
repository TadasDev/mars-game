<?php

namespace Model;

use Core\Db;

class ModelAbstract
{
    public const ID_COLUMN = 'id';
    protected $id = null;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }


    public function save()
    {
        if($this->id !== null){
            $this->update();
        }else{
            $this->create();
        }
        return $this;
    }

    public function create()
    {
        $db = new Db();
        $record = $db->insert(static::TABLE_NAME)->values($this->prepeareArray())->exec();

    }

    public function update()
    {
        $db = new Db();
        $db->update(static::TABLE_NAME)->set($this->prepeareArray())->where(self::ID_COLUMN, $this->id)->exec();
    }

    public function prepeareArray()
    {
        return [];
    }

    public function load($id)
    {

    }
}