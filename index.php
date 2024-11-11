<?php
session_start();

require_once 'controller/controllerRole.php';
require_once 'controller/controllerUser.php';
require_once 'model/barang_model.php';
require_once 'controller/controllerTransaksi.php';

//create object model

$objectRole = new controllerRole();
$obj_barang = new modelBarang();
$objectUser = new controllerUser();
$objTransaksi = new controllerTransaksi();

if (isset($_GET['modul'])){
    $modul = $_GET['modul'];
}else{
    $modul = 'dashboard';
}

switch ($modul) {
    case 'dashboard';
        include 'views/kosong.php';
        break;

    //Transaksi
    case 'transaksi':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        switch ($fitur){
            case 'add':
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    print_r($_POST);
                    $customer_name = $_POST['customer'];
                    $Customer = $objectUser->getUserByName($customer_name);
                    $Kasir = $objectUser->getUserById(1);
                    echo $Customer->name."<br>";
                    echo $Kasir->name."<br>";
                    echo "<br>";
                    // Asumsikan $_POST['barang'] dan $_POST['jumlah'] adalah array
                    $barang = $_POST['barang'];
                    $jumlah = $_POST['jumlah'];

                    $obj_barangs = [];
                    foreach ($barang as $key => $bar) {
//                        echo "Barang: " . $bar . ", Jumlah: " . $jumlah[$key] . "<br>";
                        $obj_barangs[] = $obj_barang->getBarangById($bar);
                    }
                    $objTransaksi->addTransaksi($obj_barangs,$jumlah,$Customer,$Kasir);
                } else {
//                    $listRoleName = $objectRole->getListRoleName();
                    $barangs = $obj_barang->getAllBarangs();
                    $customers = $objectUser->getUsers();
//                    foreach ($customers as $customer){
//                        echo $customer->name."<br>";
//                    }
                    include 'views/transaksi_input.php';
                }
                break;
            default:
                $objTransaksi->listTransaksi();
        }
        break;

            // Modul Barang
    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'add':
                $nama = $_POST['nama'];
                $harga = $_POST['harga'];
                $stok = $_POST['stok'];
                $obj_barang->addBarang($nama, $harga, $stok);

                header("Location: index.php?modul=barang");
                break;

            case 'edit':
                $id = $_GET['id'];
                $barang = $obj_barang->getBarangById($id);
                include 'views/barang_update.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['id'];
                    $nama = $_POST['nama'];
                    $harga = $_POST['harga'];
                    $stok = $_POST['stok'];

                    $obj_barang->updateBarang($id, $nama, $harga, $stok);
                    header("Location: index.php?modul=barang");
                }
                break;

            case 'delete':
                $id = $_GET['id'];
                $obj_barang->deleteBarang($id);
                header("Location: index.php?modul=barang");
                break;

            default:
                $barangs = $obj_barang->getAllBarangs();
                include "views/barang_list.php";
                break;
        }
        break;

        case 'user':
            $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
            switch ($fitur){
                case 'add':
                    if ($_SERVER['REQUEST_METHOD']=='POST'){
                        $name = $_POST['name'];
                        $username = $_POST['username'];
                        $passowrd = $_POST['password'];
                        $role_Status = $_POST['role_status'];
                        $users->addUser($role_status,$username,$passowrd,$name);
                    } else {
                        $listRoleName = $users->getListRoleName();
                        include 'views/user_input.php';
                    }
                    break;
                default:
                    $users->listUser();
            }
            break;

        case 'role':
            $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
            $id = isset($_GET['id']) ? $_GET['id'] : null;
                switch ($fitur){
                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $role_name = $_POST['role_name'];
                        $role_description = $_POST['role_description'];
                        $role_status = $_POST['role_status'];
                        if ($role_status == 1) {
                            $role_status = 1;
                        } else {
                            $role_status = 0;
                        }
                        $objectRole->addRole($role_name,$role_description,$role_status);
                    }else{
                        include 'views/role_input.php';
                    }
                    break;
                case 'edit':
                    $objectRole->editById($id);
                    break;
                case 'update':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $role_name = $_POST['role_name'];
                        $role_description = $_POST['role_description'];
                        $role_status = $_POST['role_status'];
                        if ($role_status == 1){
                            $objectRole->updateRole($id, $role_name, $role_description, 1);
                        }else{
                            $objectRole->updateRole($id, $role_name, $role_description, 2);
                        }
                    }
                    break;
                case 'delete':
                    $objectRole->deleteRole($id);
                    break;
                default:
                $objectRole->listRoles();
            }
            break;
        default:
            include 'views/kosong.php';
}

?>