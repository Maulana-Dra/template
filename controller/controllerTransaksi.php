<?php
require_once 'model/modelTransaksi.php';
class controllerTransaksi
{
    private $transaksiModel;

    public function __construct(){
        $this->transaksiModel = new modelTransaksi();
    }

    public function listTransaksi(){
        $transaksis = $this->transaksiModel->getAllTransaksi();
        include 'views/transaksi_list.php';
    }

    public function addTransaksi($barang,$jumlah,$customer,$kasir){
        //konversi nama barang to objek barang
        $this->transaksiModel->addTransaksi($barang,$jumlah,$customer,$kasir);
        header('location: index.php?modul=transaksi');
    }
}