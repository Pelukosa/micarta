<?php

class CoreObject
{
    static private $AppIstanciatedObjects = null;
    public $class;
    public $user;
    public $account;

    private function __construct($id = null)
    {
        $this->user = new User(1);
        $this->class = get_class($this);
    }

    public static function getInstance($id = null)
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

    public function get($field) {
        return $this->fields[$field];
    }

    public function set($field, $value) {
        $this->fields[$field] = $value;
        
        return $this;
    }
    
    public function store() {
        
        $fields = $this->getFields();
        $log = [];
        $toUpdate = "UPDATE " . $this->table . " SET ";
        foreach ($fields as $k => $v) {
            $toUpdate .= '`' . $k . '` = ' . "'" . $v . "', ";
            $log[$k] = $v;
        }
        $toUpdate .= "`LAST_MODIFICATION_TIME` = " . "'" . App::now() . "'";
        $toUpdate .= " WHERE ID = '" . $this->id . "'";
        
        self::conn()->query($toUpdate);
        self::conn()->query($this->log($log));
    }

    public function storePost($post) {
        //$checkboxFields = self::checkboxFields();
        foreach ($post as $k => $v) {
            if (is_array($v)) {
                $v = $v[0];
            }
               
            $this->set(strtoupper($k), $v);
        }
        $this->store();

        return $this;
    }

    public function getFields() {
        $fields = $this->fields;
        $fields = self::removeFieldsUpdate($fields);

        return $fields;
    }

    public static function removeFieldsUpdate($fields) {
        $remove = [
            "ID",
            "CREATOR_USER_ID",
            "CREATION_TIME",
            "LAST_MODFICATION_TIME",
            "HOST",
            "CODE"
        ];
        foreach ($remove as $row) {
            unset($fields[$row]);
        }

        return $fields;
    }

    public function log($log) {
        $fields = "(`DATE`, `ACCOUNT_ID`, `USER_ID`, `OBJECT`)";
        $values = "('".App::now()."', '".$this->account."', '".$this->user."', '".$this->table."')";
        $ret = "INSERT INTO LOG $fields VALUES $values";
        
        return $ret;
    }

    public function checkboxFields() {
        $ret = [
            "SHOW_IMAGES",
            "SHOW_PRICES"
        ];
        $ret = array_flip($ret);
        return $ret;
    }

}
