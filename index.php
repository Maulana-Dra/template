<?php 
session_start();
if( !isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require_once 'model/role_model.php';
require_once 'model/user_model.php';
require_once 'model/barang_model.php'; 
require_once 'model/transaksi_model.php'; 

// Tentukan modul yang akan ditampilkan
if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    header("Location: index.php?modul=dashboard");
}

switch ($modul) {
    case 'dashboard':
        $role_id = $_SESSION['role_id'];
        if ($role_id == 1) {
            header("Location: index.php?modul=role");
        }else if($role_id == 3){
            header("Location: index.php?modul=transaksi&fitur=add");
        }
        
        // include 'views/kosong.php';
        break;
    
    // Modul Role
    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_role = new Role_model();

        switch ($fitur) {
            case 'input':
                include 'views/role_input.php';
                break;
            case 'add':
                $role_name = $_POST['role_name'];
                $role_description = $_POST['role_description'];
                $role_status = $_POST['role_status'];
                $obj_role->addRole($role_name, $role_description, $role_status);

                header("Location: index.php?modul=role");
                break;

            case 'edit':
                $id = $_GET['id'];
                $roleData = $obj_role->getRoleById($id);
                include 'views/role_update.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['role_id'];
                    $role_name = $_POST['role_name'];
                    $role_description = $_POST['role_description'];
                    $role_status = $_POST['role_status'];

                    $obj_role->updateRole($id, $role_name, $role_description, $role_status);
                    header("Location: index.php?modul=role");
                }
                break;

            case 'delete':
                $id = $_GET['id'];
                $obj_role->deleteRole($id);
                header("Location: index.php?modul=role");
                break;

            default:
                $roles = $obj_role->getAllRoles();
                include "views/role_list.php";
                break;
        }
        break;

    // Modul User
    // Modul User
case 'user':
    $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
    $listRole = new Role_model(); 
    $obj_user = new UserModel();

    switch ($fitur) {
        case 'input':
            $roles = $listRole->getAllRoles(); // pastikan roles diambil dari model
            $users = $obj_user->getAllUsers(); // jika diperlukan
            include './views/user_input.php';
            break;
        
            
        case 'add':
            // Pastikan nama variabel sesuai dengan form input
            $user_name = $_POST['username'];
            $user_password = $_POST['password'];
            $role_id = $_POST['role']; 
            $obj_user->addUser($user_name, $user_password, $role_id);

            // Redirect ke modul user setelah penambahan
            header("Location: index.php?modul=user");
            break;


            case 'edit':
                $id = $_GET['id'];
                $user = $obj_user->getUserById($id);
                $roles = $listRole->getAllRoles();
                include 'views/user_update.php';
                break;

            case 'update':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id = $_POST['user_id'];
                    $user_name = $_POST['user_name'];
                    $user_password = $_POST['user_password'];
                    $role_id = $_POST['role_id'];

                    $obj_user->updateUser($id, $user_name, $user_password, $role_id);
                    header("Location: index.php?modul=user");
                }
                break;

            case 'delete':
                $id = $_GET['id'];
                $obj_user->deleteUser($id);
                header("Location: index.php?modul=user");
                break;

            default:
                $users = $obj_user->getAllUsers();
                include "views/user_list.php";
                break;
        }
        break;

    // Modul Barang
    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_barang = new modelBarang();

        switch ($fitur) {
            case 'input':
                include 'views/barang_input.php';
                break;
                
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

        // Modul Transaksi
        case 'transaksi':
            // Ambil fitur dari parameter GET
            $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        
            // Inisialisasi objek model
            $obj_barang = new modelBarang();
            $obj_user = new UserModel();
            $objTransaksi = new modelTransaksi(); // Pastikan objek ini diinisialisasi
        
            switch ($fitur) {
                case 'add':
                    // Ambil semua customer dan barang yang tersedia
                    $customers = $obj_user->getAllCustomers();
                    $barangs = $obj_barang->getAvailableBarangs();
        
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // Ambil ID customer dari POST
                        $customer_id = $_POST['customer'];
                        $Customer = $obj_user->getUserById($customer_id);
                        $kasir_username = $_SESSION['username'];
                        $Kasir = $obj_user->getUserByName($kasir_username); 
        
                        // Validasi apakah customer dan kasir ditemukan
                        if ($Customer && $Kasir) {
                            $barang = $_POST['barang'];
                            $jumlah = $_POST['jumlah'];
                            $bayar = $_POST['bayar'];  // Ambil nilai bayar dari form
                            $kembalian = $_POST['kembalian'];
        
                            // Ambil objek barang berdasarkan ID
                            $obj_barangs = [];
                            $stokCukup = true;
                            foreach ($barang as $key => $bar) {
                                $obj_barang_item = $obj_barang->getBarangById($bar);
                                if ($obj_barang_item) {
                                    // Cek apakah stok mencukupi
                                    if ($obj_barang_item->stok >= $jumlah[$key]) {
                                        $obj_barangs[] = $obj_barang_item;
                                    } else {
                                        echo "
                                            <script>
                                                alert('Stok $obj_barang_item->nama tidak mencukupi!');
                                                document.location.href = 'index.php?modul=transaksi&fitur=add';
                                            </script>
                                        ";
                                        $stokCukup = false;
                                    }
                                } else {
                                    echo "
                                            <script>
                                                alert('Barang $bar tidak ditemukan!');
                                            </script>
                                        ";
                                    $stokCukup = false;
                                }
                            }
        
                            // Tambahkan transaksi jika barang valid
                            if ($stokCukup && !empty($obj_barangs)) {
                                $objTransaksi->addTransaksi($obj_barangs, $jumlah, $Customer, $Kasir, $total, $bayar, $kembalian,tanggal: date('Y-m-d'));
                                foreach ($obj_barangs as $key => $item) {
                                    $obj_barang->updateStok($item->id, $jumlah[$key]); // Menggunakan notasi objek
                                }
                                header("Location: index.php?modul=transaksi");
                                exit();  // Pastikan untuk menghentikan script setelah redirect
                             }
                        } else {
                            echo "
                                    <script>
                                        alert('customer atau kasir tidak ditemukan');
                                        document.location.href = 'index.php?modul=transaksi&fitur=add';
                                    </script>
                                ";
                        }
                    } else {
                        // Tampilkan form input transaksi
                        include 'views/transaksi_input.php';
                    }
                    break;
        
                default:
                    // Ambil dan tampilkan daftar transaksi
                    $transaksiList = $objTransaksi->getAllTransaksi();
                    include 'views/transaksi_list.php';
            }
            break;

        
}
?>