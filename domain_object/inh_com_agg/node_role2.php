<?php 
class nodeMobil{
    public $mobil_id;
    public $mobil_name;
    public $mobil_tipe;
    public $mobil_mesin;

    public function Cetakmobil(){
        echo "ID mobil: ".$this->mobil_id."<br>";
        echo "Name mobil: ".$this->mobil_name."<br>";
        echo "Tipe mobil: ".$this->mobil_tipe."<br>";
        echo "Mesin mobil: ".$this->mobil_mesin."<br>";
    }
    function __construct($mobil_id, $mobil_name, $mobil_tipe, $mobil_mesin)
    {
        $this->mobil_id = $mobil_id;
        $this->mobil_name = $mobil_name;
        $this->mobil_tipe = $mobil_tipe;
        $this->mobil_mesin = $mobil_mesin;
    }
}
?>