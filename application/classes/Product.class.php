<?php

class Product extends CoreObject
{

    public $table;
    public $user;

    public function __construct($id = "")
    {
        $this->table = "product";
        $this->class = get_class($this);
        $this->user = new User(1);
        $this->id = $id;
        $this->structure = $this->getStructure();
        $this->fields = $this->getObjectFields();
    }



    public function renderAllProducts()
    {
        $ret = $this->getList();

        return $ret;
    }

    public function getPublicList($auxQuery = null)
    {
        $host = parent::getHost();
        $table = $this->table;
        $query = "SELECT * FROM $table WHERE TRUE $auxQuery AND `HOST` = '$host'";
        $rs = self::conn()->query($query);
        $data = [];
        foreach ($rs as $v) {
            $data[$v["ID"]] = $v;
        }

        return $data;
    }

    public function getObject($id)
    {
        $product = self::getList(" AND ID = '$id'");
        foreach ($product as $v) {
            return $v;
        }
        return false;
    }

    public function count($auxQuery = "")
    {
        $userId = $this->user->id;
        $table = $this->table;
        $query = "SELECT COUNT(*) FROM $table WHERE `USER` = '$userId' $auxQuery";
        $rs = self::conn()->query($query);
        foreach ($rs as $v) {
            return $v["COUNT(*)"];
        }
    }

    public function countActiveProducts()
    {
        $productFamily = new ProductFamily();
        $families = $productFamily->getUserFamilies();

        $familyCodesByUser = array();
        foreach ($families as $family) {
            $familyCodesByUser[] = $family["CODE"];
        }
        $ret = self::count(" AND FAMILY_CODE IN ('" . implode("','", $familyCodesByUser) . "')");
        
        return $ret;
 
    }

    public function generateNewCode($familyCode)
    {
        $lastProductByFamily  = $this->getList(" AND USER = '" . $this->user->id . "' AND FAMILY_CODE = '$familyCode' ORDER BY CODE DESC LIMIT 1");
        foreach ($lastProductByFamily as $row) {
            $newCode = intval(explode("-", $row["CODE"])[2]) + 1;
        }
        
        if ($newCode) {
            $newCode = $this->user->id . "-" . $familyCode . "-" . $newCode;
        } else {
            $newCode = $this->user->id . "-" . $familyCode . "-1";
        }

        return $newCode;
    }
}