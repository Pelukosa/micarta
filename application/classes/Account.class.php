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
        $this->account_config = $this->getAccountConfig();
        $this->class = get_class($this);
    }

    private function getAccountConfig() {
        $query = "SELECT * FROM account_config WHERE ACCOUNT_ID = '$this->id' LIMIT 1";
        $rs = self::conn()->query($query);
        foreach ($rs as $v) {
            $data = $v;
        }
        
        return $data;
    }
    
}