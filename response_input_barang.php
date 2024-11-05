<?php
require_once 'domain_object/node_barang.php';
$obj_barang = [];
$obj_barang[] = new barang(1,$_POST['nama'],$_POST['harga'],$_POST['stok']);
include 'views/barang_list.php';

?>