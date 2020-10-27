<?php

class App {
    
    public static function prePrint($data)
    {
        echo '<pre>', print_r($data, true), '</pre>';
    }

    public function renderSelector() {

    }

    public function getCounties() {
        $query = "SELECT * FROM COUNTY";
        $rs = CoreObject::conn()->query($query);
        $data = [];
        foreach ($rs as $v) {
            $data[$v["CODE"]] = $v["NAME"];
        }

        return $data;
    }

}