<?php 

class Form {

    public function renderCheckbox($field) {
        $ret = "";
    }

    public static function renderSavebutton() {
        echo '<input type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 mr-4 border-b-4 border-blue-700 hover:border-blue-500 rounded cursor-pointer" style="float: left;" value="Guardar">';
    }

    public static function renderSendButton() {
        echo '<input type="submit" class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 mr-4 border-b-4 border-green-700 hover:border-green-500 rounded cursor-pointer" style="float: left;" value="Enviar">';
    }

}