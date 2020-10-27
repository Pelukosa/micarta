<?php 

class User extends CoreObject {

    public $id;
    public $table;
    public $productFamilies;
    public $fields;
    public $class;

    public function __construct($id) {
        $this->table = "user";
        $this->productFamilies = "USER";
        $this->id = $id;
        $this->structure = $this->getStructure();
        $this->fields = $this->getObjectFields();
        $this->user_config = $this->getUserConfig();
        $this->class = get_class($this);
    }

    private function getUserConfig() {
        $query = "SELECT * FROM user_config WHERE USER_ID = '$this->id' LIMIT 1";
        $rs = self::conn()->query($query);
        foreach ($rs as $v) {
            $data = $v;
        }
        
        return $data;
    }

    public function createUser() {
        
        $opciones = [
            'cost' => 12,
        ];
        $psswd = "Arronches123";
        $psswdHash = password_hash($psswd, PASSWORD_BCRYPT, $opciones);
        $query = "INSERT INTO user (`CREATION_TIME`, `LOGIN`, `PSSWD`) VALUES (NOW(), 'admin', '$psswdHash')";

        self::conn()->query($query);
    }

    public function getProductFamilies() {
        
    }

    public function showFamilyIcons() {
        if ($this->user_config["SHOW_FAMILY_ICON"] == "1") {
            return true;
        }
        return false;
    }

    public function showProductImage() {
        if ($this->user_config["SHOW_PRODUCT_IMAGE"] == "1") {
            return true;
        }
        return false;
    }

}