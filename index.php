<?php
require_once 'model/role_model.php';
require_once 'model/barang_model.php';
require_once 'model/user_model.php';
session_start();
//create object model

if (isset($_GET['modul'])){
    $modul = $_GET['modul'];
}else{
    $modul = 'dashboard';
}

switch ($modul) {
    case 'dashboard';
        include 'views/kosong.php';
        break;
    case 'role';
        //menangkap value dari parameter fitur
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_roleModel = new Role_model();   //create objectss
        switch ($fitur) {
            case 'add';
                //get variabel form form
                $id = $_POST['role_id'];
                $role_name = $_POST['role_name'];
                $role_description = $_POST['role_description'];
                $role_status = $_POST['role_status'];
                //add to object role
                $obj_roleModel->addRole($role_name,$role_description,$role_status);
                //arahkan ke index.php
                header('location: index.php?modul=role');
                break;
                
                case 'edit':
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $role = $obj_roleModel->getRoleById($id);
                        include 'views/role_update.php';
                    }
                    break;
    
                case 'update':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id = $_POST['role_id'];
                        $role_name = $_POST['role_name'];
                        $role_description = $_POST['role_description'];
                        $role_status = $_POST['role_status'];
    
                        $obj_roleModel->updateRole($id, $role_name, $role_description, $role_status);
                        header("Location: index.php?modul=role");
                    }
                    break;
                case 'delete':
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $obj_roleModel->deleteRole($id);
                        header("Location: index.php?modul=role");
                    }
                    break;
                default;
                    $roles = $obj_roleModel->getAllRoles(); //get roles []
                    include 'views/role_list.php';
            }
            break;

            // Modul Barang
    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_barang = new modelBarang();

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

        $users = new User_model();
        $roles = new Role_model();
        switch($fitur){
            case 'input':
                $users = $users->getAllUsers();
                $listRole = $roles->getAllRoles();
                include './views/user_input.php';
                break;

            case 'add':
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $user = $_POST['name'];
                    $nameRole = $_POST['role_status'];
                    $result = $users->addUser($user, $nameRole);
                    if($result){
                        echo "<script>
                            alert('Data berhasil ditambahkan!');
                            window.location.href = 'index.php?modul=user';
                        </script>";
                    }else{
                        echo "<script>
                            alert('Data gagal ditambahkan!');
                            window.location.href = 'index.php?modul=user';
                        </script>";
                    }
                }
                include './views/user_input.php';
                break;
            case 'edit':
                $userID = $_GET['id'];
                $user = $users->getUserById($userID);
                $listRole = $roles->getAllRoles();
                include './views/user_update.php';
                break;

            case 'update':
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $userID = $_POST['id_user'];
                    $user = $_POST['name'];
                    $nameRole = $_POST['role_status'];
                    $result = $users->updateUser($userID,$user, $nameRole);
                    if($result){
                        echo "<script>
                            alert('Data berhasil diupdate!');
                            window.location.href = 'index.php?modul=user';
                        </script>";
                    }else{
                        echo "<script>
                            alert('Data gagal diupdate!');
                            window.location.href = 'index.php?modul=user';
                        </script>";
                    }
                }

            case 'delete':
                $userID = $_GET['id']; // Ambil ID pengguna dari URL
                if ($users->deleteUser ($userID)) { // Panggil method deleteUser 
                    echo "<script>
                        alert('Pengguna berhasil dihapus!');
                        window.location.href = 'index.php?modul=user';
                    </script>";
                } else {
                    echo "<script>
                        alert('Pengguna tidak ditemukan atau gagal dihapus!');
                        window.location.href = 'index.php?modul=user';
                    </script>";
                }
                break;
            default:

                $users = $users->getAllUsers();
                include './views/user_list.php';
                break;
            }
            break;



}

?>