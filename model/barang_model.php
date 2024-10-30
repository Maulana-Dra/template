<?php
    require_once 'domain_object/node_barang.php';

class Barang_model{
    private $barangs = [];
    private $nextId = 1;
    public function __construct(){
        if(isset($_SESSION['barangs'])){
            $this->barangs = unserialize($_SESSION['barangs']);
            $this->nextId = count($this->barangs);
        }else{
            $this->initiliazeDefaultBarang();
        }
    }
    public function initiliazeDefaultBarang(){
        
        $this->addBarang("Laptop","1000",10);
        $this->addBarang("Handphone","500",30);
        $this->addBarang("Buku","50",500);
    }
    public function addBarang($barang_name,$barang_description,$barang_status){
        $id = count($this->barangs)+1;
        $item = new Barang ($id, $barang_name, $barang_description, $barang_status);
        $this->barangs[] = $item;
        $this->saveToSession();
    }
    public function saveToSession(){
        $_SESSION['barangs'] = serialize($this->barangs);
    }
    public function getAllBarangs(){
        return $this->barangs;    
    }
    public function getBarangById($barang_id){
        foreach($this->barangs as $barang){
            if($barang->barang_id == $barang_id){
                return $barang;
            }
        }
        return null;
    }
    public function getBarangByName($barang_name){
        foreach ($this->barangs as $barang){
            if($barang->barang_name == $barang_name){
                return $barang;
            }
        }
    }
    public function updateBarang($barang_id,$barang_name,$barang_description,$barang_status){
        foreach ($this->barangs as $barang){
            if($barang->barang_id == $barang_id){
                $barang->barang_name = $barang_name;
                $barang->barang_description = $barang_description;
                $barang->barang_status = $barang_status;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    public function deleteBarang($barang_id){
        foreach ($this->barangs as $key => $barang){
            if ($barang->barang_id == $barang_id){
                unset($this->barangs[$key]);
                $this->barangs= array_values($this->barangs);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    } 
}
?>