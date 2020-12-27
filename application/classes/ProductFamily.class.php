<?php

class ProductFamily extends CoreObject {

    public $table;
    public $user;
    public $account;

    public function __construct() {
        $this->table = "product_family";
        $this->_realName = "Categoria";
        $this->_realPluralName = "Categorias";
        $this->user = new User(1);
        $this->account = new Account(1);
    }

    public function _getList() {

    }

    public function getAccountFamilies() {
        $account = $this->account;
        $accountFamilies = $account->account_config["PRODUCT_FAMILIES_CODE"];
        $accountFamilies = array_filter(explode("|", $accountFamilies));
        $accountFamilies = "'" . implode("','", $accountFamilies) . "'";
        $productFamilies = parent::getList(" AND CODE IN ($accountFamilies)");

        return $productFamilies;

    }

    public function getHostFamilies() {
        $domainHost = parent::getHost();
        $query = "SELECT ID FROM account WHERE `HOST` = '$domainHost'";
        $rs = self::conn()->query($query);
        foreach ($rs as $v) {
            $account = new Account($v["ID"]);
        }
        $accountFamilies = $account->account_config["PRODUCT_FAMILIES_CODE"];
        $accountFamilies = array_filter(explode("|", $accountFamilies));
        $accountFamilies = "'" . implode("','", $accountFamilies) . "'";
        $productFamilies = parent::getList(" AND CODE IN ($accountFamilies)");
        
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