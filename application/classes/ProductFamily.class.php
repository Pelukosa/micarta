<?php

class ProductFamily extends CoreObject {

    public $table;
    public $user;

    public function __construct() {
        $this->table = "product_family";
        $this->user = new User(1);
    }

    public function _getList() {

    }

    public function getUserFamilies() {
        $user = $this->user;
        $userFamilies = $user->user_config["PRODUCT_FAMILIES_CODE"];
        $userFamilies = array_filter(explode("|", $userFamilies));
        $userFamilies = "'" . implode("','", $userFamilies) . "'";
        $productFamilies = parent::getList(" AND CODE IN ($userFamilies)");

        return $productFamilies;

    }

    public function getHostFamilies() {
        $domainHost = parent::getHost();
        $query = "SELECT ID FROM user WHERE `HOST` = '$domainHost'";
        $rs = self::conn()->query($query);
        foreach ($rs as $v) {
            $user = new User($v["ID"]);
        }
        $userFamilies = $user->user_config["PRODUCT_FAMILIES_CODE"];
        $userFamilies = array_filter(explode("|", $userFamilies));
        $userFamilies = "'" . implode("','", $userFamilies) . "'";
        $productFamilies = parent::getList(" AND CODE IN ($userFamilies)");
        
        return $productFamilies;

    }


    public function count() {
        $userFamilies = $this->user->user_config["PRODUCT_FAMILIES_CODE"];
        $userFamilies = array_filter(explode("|", $userFamilies));
        $codes = "'" . implode("','", $userFamilies) . "'";
        $table = $this->table;
        $query = "SELECT COUNT(*) FROM $table WHERE `CODE` IN ($codes)";
        $rs = self::conn()->query($query);
        foreach ($rs as $v) {
            return $v["COUNT(*)"];
        }

    }


}