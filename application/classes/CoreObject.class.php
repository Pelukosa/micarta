<?php

class CoreObject
{
    static private $AppIstanciatedObjects = null;
    public $class;
    public $user;

    private function __construct($id = null)
    {
        $this->user = new User(1);
        $this->class = get_class($this);
    }

    public function getInstance($id = null)
    {
        $class = get_called_class();

        if (self::$AppIstanciatedObjects[$class][$id]) {
            return self::$AppIstanciatedObjects[$class][$id];
        }

        try {
            return new $class($id);
        } catch (Exception $e) {
            return new $class();
        }
    }

    public static function conn()
    {
        $conn = require  $_SERVER['DOCUMENT_ROOT'] . "/application/config/database.php";
        return $conn;
    }

    private function store()
    {
        $query = "INSERT INTO user (`CREATION_TIME`, `LOGIN`, `PSSWD`) VALUES ()";
    }

    public static function query($query)
    {
        $ret = self::conn()->query($query);
        if ($ret) {
            return $ret;
        }
        return false;
    }

    public function getHost()
    {
        $domainHost = array_shift((explode('.', $_SERVER['HTTP_HOST'])));

        return $domainHost;
    }

    public function getObjectFields()
    {
        $array = $this->getList(" AND ID = '$this->id' LIMIT 1");


        foreach ($array as $row) {
            $object = $row;
        }

        return $object;
    }

    public function get($field)
    {
        $table = $this->table();
        $query = "SELECT $field FROM $table WHERE ID = '$this->$field'";
        $rs = self::conn()->query($query);
        $data = [];
        foreach ($rs as $v) {
            $data[$v["ID"]] = $v;
        }

        return $data;
    }

    public function getList($auxQuery = null)
    {
        $table = $this->table();
        $query = "SELECT * FROM $table WHERE TRUE $auxQuery";
        $rs = self::conn()->query($query);
        $data = [];
        foreach ($rs as $v) {
            $data[$v["ID"]] = $v;
        }

        return $data;
    }

    public function deleteObject()
    {
        $table = $this->table;
        $id = $this->id;
        $query = "DELETE FROM $table WHERE ID = '" . $id . "'";
        self::conn()->query($query);

        return true;
    }

    private function table()
    {
        return $this->table;
    }

    public function count()
    {
    }

    public function getStructure()
    {
        $query = self::conn()->query("SHOW COLUMNS FROM $this->table");
        $fields = array();
        while ($v = mysqli_fetch_assoc($query)) {
            $fields[$v["Field"]] = "";
        }
        return $fields;
    }
}
