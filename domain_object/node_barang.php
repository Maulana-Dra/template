<?php 
class Barang{
    public $barang_id;
    public $barang_name;
    public $barang_harga;
    public $barang_stock;

    function __construct($barang_id,$barang_name, $barang_harga, $barang_stock){
        $this->barang_id = $barang_id;
        $this->barang_name = $barang_name;
        $this->barang_harga = $barang_harga;
        $this->barang_stock = $barang_stock;
    }
}
?>