<?php

namespace Model;

use Core\Db;

class Duk
{
    public const DUK = 'duk';

    private $duk;

    public function getDuk()
    {

        $db = new Db();
        $results =  $db->select()->from(self::DUK)->get();
        foreach ($results as $result){
            $this->duk[] = $result;

        }

        return $this->duk;

    }
}
