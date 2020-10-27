<?php

class Template {

    public function renderPanelMenu() {
        $ret = require  $_SERVER['DOCUMENT_ROOT'] . "/application/templates/panel/menu.php";
        return $ret;
    }

    public function renderProductsStats() {
        $ret = require  $_SERVER['DOCUMENT_ROOT'] . "/application/templates/panel/products-stats.php";
        return $ret;
    }

}