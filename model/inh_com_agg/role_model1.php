<?php 
require 'domain_object/node_role1.php';

class User extends mobil{
    public $Pengguna;

    function __construct($mobil_id, $mobil_name, $mobil_tipe, $mobil_mesin, $Pengguna)
    { 
        parent::__construct($mobil_id, $mobil_name, $mobil_tipe, $mobil_mesin);
            $this->Pengguna = $Pengguna;
    }

    public function user(){
        return "Pengguna: " . $this->Pengguna;
    }
}


?>