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
            $data[$v["ID"]] = $v["NAME"];
        }

        return $data;
    }

    public static function getHost() {
        return "https://" . $_SERVER['HTTP_HOST'];
    }

    public static function now() {
        return Date("Y-m-d H:i:s");
    }

}