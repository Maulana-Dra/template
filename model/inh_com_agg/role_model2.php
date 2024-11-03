
<?php 
require_once(__DIR__ . '/../domain_object/node_role2.php');

class Mobil{
    public $Pengguna;
    public $mobil;

    public function __construct($mobil_id, $mobil_name, $mobil_description, $mobil_status, $Pengguna)
    {
        $this->mobil = new nodeMobil($mobil_id, $mobil_name, $mobil_description, $mobil_status, $Pengguna);
        $this->mobil->mobil_id = $mobil_id;
        $this->mobil->mobil_name = $mobil_name;
        $this->mobil->mobil_description = $mobil_description;
        $this->mobil->mobil_status = $mobil_status;
        $this->Pengguna = $Pengguna;
    }

    public function CetakUser(){
        $this->mobil->Cetakmobil();
        echo "Pengguna: ".$this->Pengguna."<br>";
    }

    
}

?>
