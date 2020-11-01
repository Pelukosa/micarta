<?php 

class Account extends CoreObject {

    public $id;
    public $table;
    public $fields;
    public $class;
    public $account;

    public function __construct($id) {
        $this->table = "account";
        $this->id = $id;
        $this->structure = $this->getStructure();
        $this->fields = $this->getObjectFields();
        $this->class = get_class($this);
    }

}