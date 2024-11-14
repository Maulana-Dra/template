<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TEMPLATE/domain_object/node_transaksi.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/TEMPLATE/model/user_model.php'; // Pastikan Anda mengimpor UserModel
require_once $_SERVER['DOCUMENT_ROOT'] . '/TEMPLATE/model/barang_model.php'; // Pastikan Anda mengimpor modelBarang

class modelTransaksi {
    private $transaksis = [];
    private $nextId = 1;

    public function __construct() {
        if (isset($_SESSION['transaksis'])) {
            $this->transaksis = unserialize($_SESSION['transaksis']);
            $this->nextId = count($this->transaksis) + 1;
        } else {
            $this->initializeDefaultTransaksi();
        }
    }

    public function addTransaksi($barang, $jumlah, $customer, $kasir, $total, $bayar, $kembalian, $tanggal)
    {
        $transaksi = new nodeTransaksi($this->nextId++, $barang, $jumlah, $customer, $kasir, $total, $bayar, $kembalian, $tanggal);
        $this->transaksis[] = $transaksi;
        $this->saveToSession();
    }



    private function saveToSession() {
        $_SESSION['transaksis'] = serialize($this->transaksis);
    }

    public function getAllTransaksi() {
        return $this->transaksis;
    }

    public function getBarangInTransaksi($id) {
        foreach ($this->transaksis as $transaksi) {
            if ($transaksi->idTransaksi == $id) {
                return $transaksi->barangs;
            }
        }
        return null;
    }

    private function initializeDefaultTransaksi() {
        // Inisialisasi objek User dan Barang
        $objUser = new UserModel();
        $objBarang = new modelBarang();
    
        // Mendapatkan data barang dari modelBarang
        $barang1 = $objBarang->getBarangById(1);
        $barang2 = $objBarang->getBarangById(2);
        $barang3 = $objBarang->getBarangById(3);
    
        // Memastikan barang ditemukan
        if (!$barang1 || !$barang2) {
            return;
        }
    
        // Mendapatkan data user dari UserModel
        $customer = $objUser->getUserById(2); 
        $kasir = $objUser->getUserById(3);
    
        // Memastikan customer dan kasir ditemukan
        if (!$customer || !$kasir) {
            return;
        }
    
        // Transaksi A (Contoh 1)
        $barangsA = [$barang1, $barang2];
        $jumlahsA = [2, 6]; // Jumlah barang yang dibeli
    
        // Hitung total untuk transaksi A
        $totalA = 0;
        foreach ($barangsA as $key => $barang) {
            $totalA += $barang->harga * $jumlahsA[$key];
        }
    
        $bayarA = $totalA + 5000; // Contoh bayar lebih dari total
        $kembalianA = $bayarA - $totalA;
    
        // Menambahkan tanggal transaksi
        $tanggalA = date('Y-m-d'); // Mendapatkan tanggal dan waktu sekarang
    
        // Tambahkan Transaksi A dengan tanggal
        $this->addTransaksi($barangsA, $jumlahsA, $customer, $kasir, $totalA, $bayarA, $kembalianA, $tanggalA);
    
        // Transaksi B (Contoh 2)
        $barangsB = [$barang1,$barang3];
        $jumlahsB = [3, 5]; // Jumlah barang yang dibeli
    
        // Hitung total untuk transaksi B
        $totalB = 0;
        foreach ($barangsB as $key => $barang) {
            $totalB += $barang->harga * $jumlahsB[$key];
        }
    
        $bayarB = $totalB + 10000; // Contoh bayar lebih dari total
        $kembalianB = $bayarB - $totalB;
    
        // Menambahkan tanggal transaksi
        $tanggalB = date('Y-m-d'); // Mendapatkan tanggal dan waktu sekarang
    
        // Tambahkan Transaksi B dengan tanggal
        $this->addTransaksi($barangsB, $jumlahsB, $customer, $kasir, $totalB, $bayarB, $kembalianB, $tanggalB);
    
        // Simpan ke sesi
        $this->saveToSession();
    }
    
    
}
?>