<?php
require_once './domain_object/node_user.php';
require_once 'role_model.php';
// require_once './user_model.php';

class User_model{
    // MENYIMPAN SEMUA DATA USER
    private $users = [];

    // SEPERTI BIASA AUTO INCREMENT
    private $nextID = 1;

    // SEMUA METHOD MODEL BISA KITA MANFAATKAN
    private $roleModel;

    public function __construct(){
        $this->roleModel = new role_model();
        // CEK APAKAH SESSION TERSEDIA
        if(isset($_SESSION['users'])){
            $this->users = unserialize($_SESSION['users']);
        }else{
            $this->InitilizedefaultUser();
        }
    }

    public function addUser($user, $nameRole){
        $role = $this->roleModel->getRoleByName($nameRole);


        if(!$role){
            echo "<script>
            alert('Role Tidak Ditemukan Kocak!');
            </script>";
            return false;
        }

        if($role->role_status == 0){
            echo "<script>
            alert('Role Tidak Aktif Kocak!');
            </script>";
            return false;
        }

        $ID = count($this->users) + 1;
        $this->users[] = new User($ID,$user, $role);
        $this->saveToSession();
        return true;
        
    }


    public function saveToSession(){
        $_SESSION['users'] = serialize($this->users);
    }


    public function InitilizedefaultUser(){
        $this->addUser("Maulana", "Admin");
        $this->addUser("Indah", "Kasir");
    }

    public function getAllUsers(){
        return $this->users;
    }

    public function updateUser($userID,$username, $nameRole){
        $role = $this->roleModel->getRoleByName($nameRole);
        if(!$role){
            echo "<script>
            alert('Role Tidak Ditemukan Kocak!');
            </script>";
            return false;
        }
        if($role->role_status == 0){
            echo "<script>
            alert('Role Tidak Aktif Kocak!');
            </script>";
            return false;
        }
        foreach($this->users as $key => $user){
            if($user->userId == $userID){
                $user->username = $username;
                $user->allDataRole = $role;
                // $this->users[$key] = new User($user->userId, $user->username, $role);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function getUserById($id){
        foreach($this->users as $user){
            if($user->userId == $id){
                return $user;
            }
        }
        return false;
    }


    public function deleteUser($id){
        foreach($this->users as $key => $user){
            if($user->userId == $id){
                unset($this->users[$key]);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

}


?>