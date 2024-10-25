<?php 
class Barang{
    public $nama;
    public $harga;

    function __construct($nama, $harga)
    {
        $this->nama = $nama;
        $this->harga = $harga;
    }
}

?>