<?php 
require_once(__DIR__ . '/../domain_object/node_role3.php');

class Mobils {
    public $Pengguna;
    public $mobil;

    public function __construct($mesin,$Pengguna)
    {
        $this->mobil = $mesin;
        $this->Pengguna = $Pengguna;
    }

    public function CetakPengguna(){
        $this->mobil->CetakMobil();
        echo "Pengguna: ".$this->Pengguna."<br>";
    }
}

class MobilModel {
    public $listMobil = [];

    public function AddUser($mobil_name, $mobil_tipe, $mobil_mesin, $Pengguna){
        $id = count($this->listMobil) + 1;
        $mobil = new mobil($id, $mobil_name, $mobil_tipe, $mobil_mesin);
        $this->listMobil[] = new Mobils($mobil, $Pengguna);
    }
}
?>