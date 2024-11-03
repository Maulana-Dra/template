<?php
class mobil {
    public $mobil_id;
    public $mobil_name;
    public $mobil_tipe;
    public $mobil_mesin;

    function __construct($mobil_id,$mobil_name,$mobil_tipe,$mobil_mesin){

    $this->mobil_id = $mobil_id;
    $this->mobil_name = $mobil_name;
    $this->mobil_tipe = $mobil_tipe;
    $this->mobil_mesin = $mobil_mesin;
    }
}
?>