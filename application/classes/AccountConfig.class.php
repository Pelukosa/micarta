<?php 

class AccountConfig extends Account {

    public $id;
    public $table;
    public $fields;
    public $class;

    public function __construct($id) {
        $this->table = "account_config";
        $this->id = $id;
        $this->structure = $this->getStructure();
        $this->fields = $this->getObjectFields();
        $this->class = get_class($this);
    }

    public function getCartStyle() {
        $styleId = $this->fields["CART_STYLE_ID"];
        $styleFile = App::query("SELECT `FILE` FROM CART_STYLE WHERE ID = '".$styleId."'");
        foreach ($styleFile as $row) {
            $filename = $row["FILE"];
        }

        $ret = App::getHost() . "/assets/css/templates/".$filename.".css";

        return $ret;
    }

}