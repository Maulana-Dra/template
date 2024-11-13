<?php

class nodeTransaksi
{
    public $idTransaksi;
    public $barangs = [];
    public $jumlahs = [];
    public $total;
    public $bayar;
    public $kembalian;
    public $customer;
    public $kasir;
    public $tanggal;  // Menambahkan properti tanggal

    public function __construct($idTransaksi, $barang, $jumlah, $customer, $kasir, $total, $bayar, $kembalian, $tanggal)
    {
        $this->idTransaksi = $idTransaksi;
        $this->barangs = $barang;
        $this->jumlahs = $jumlah;
        $this->customer = $customer;
        $this->kasir = $kasir;
        $this->total = $total;
        $this->bayar = $bayar;
        $this->kembalian = $kembalian;
        $this->tanggal = $tanggal;  // Menetapkan tanggal transaksi
    }
}