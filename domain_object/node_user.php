<?php
class User{
    public $userId;
    public $username;
    public $allDataRole;

    public function __construct($userId,$username,role $allDataRole){
        $this->userId = $userId;
        $this->username = $username;
        $this->allDataRole = $allDataRole;
    }
}

?>