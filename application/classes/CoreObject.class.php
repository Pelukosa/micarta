<?php

class CoreObject
{

    public $class;
    public $user;

    private function __construct()
    {
        $this->user = new User(1);
        $this->class = get_class($this);
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

    public function query($query) {
        if (self::conn()->query($query)) {
            return true;
        }
        return false;
    }

    public function getInstance($id)
    {
        $object = new $this->class($id);
        return $object;
    }

    public function getHost() {
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
