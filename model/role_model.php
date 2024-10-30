<?php
    require_once 'domain_object/node_role.php';

class Role_model{
    private $roles = [];
    private $nextId = 1;
    public function __construct(){
        if(isset($_SESSION['roles'])){
            $this->roles = unserialize($_SESSION['roles']);
            $this->nextId = count($this->roles);
        }else{
            $this->initiliazeDefaultRole();
        }
    }
    public function initiliazeDefaultRole(){
        
        $this->addRole("Admin","Administrator",1);
        $this->addRole("Customer","Customer/Member",1);
        $this->addRole("Kasir","Pembayaran",0);
    }
    public function addRole($role_name,$role_description,$role_status){
        $id = count($this->roles)+1;
        $peran = new Role ($id, $role_name, $role_description, $role_status);
        $this->roles[] = $peran;
        $this->saveToSession();
    }
    public function saveToSession(){
        $_SESSION['roles'] = serialize($this->roles);
    }
    public function getAllRoles(){
        return $this->roles;    
    }
    public function getRoleById($role_id){
        foreach($this->roles as $role){
            if($role->role_id == $role_id){
                return $role;
            }
        }
        return null;
    }
    public function getRoleByName($role_name){
        foreach ($this->roles as $role){
            if($role->role_name == $role_name){
                return $role;
            }
        }
    }
    public function updateRole($role_id,$role_name,$role_description,$role_status){
        foreach ($this->roles as $role){
            if($role->role_id == $role_id){
                $role->role_name = $role_name;
                $role->role_description = $role_description;
                $role->role_status = $role_status;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    public function deleteRole($role_id){
        foreach ($this->roles as $key => $role){
            if ($role->role_id == $role_id){
                unset($this->roles[$key]);
                $this->roles= array_values($this->roles);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    } 
}
?>