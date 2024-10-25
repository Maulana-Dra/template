<?php
    session_start();

    require_once 'model/role_model.php';

    echo "== default data =="."<br>";
    //testing create model and views all data
    $obj_role = new Role_model();   
    echo"== testing composite =="."<br>";
    foreach ($obj_role->getAllRoles() as $role) {
        echo "Role Id = ". $role->role_id ."<br>";
        echo "Role Nama = ". $role->role_name ."<br>";
        echo "Role Description = ". $role->role_description ."<br>";
        echo "Role Status = ". $role->role_status ."<br><br>";
    }

    //add new role
    echo "== Add New Role == "."<br>";
    $obj_role->addRole("new role","testing new role", 0);
    $obj_role->addRole("very new role","testing newww role", 1);
    foreach ($obj_role->getAllRoles() as $role) {
        echo "Role Id = ". $role->role_id ."<br>";
        echo "Role Nama = ". $role->role_name ."<br>";
        echo "Role Description = ". $role->role_description ."<br>";
        echo "Role Status = ". $role->role_status ."<br><br>";
    }

    //update role
    echo"== Update Data Role =="."<br>";
    $obj_role->updateRole("1","update role","role terupdate",1);
    foreach ($obj_role->getAllRoles() as $role) {
        echo "Role Id = ". $role->role_id ."<br>";
        echo "Role Nama = ". $role->role_name ."<br>";
        echo "Role Description = ". $role->role_description ."<br>";
        echo "Role Status = ". $role->role_status ."<br><br>";
    }

    //delete role
    echo"== Delete Role =="."<br>";
    $obj_role->deleteRole("1");
    foreach ($obj_role->getAllRoles() as $role) {
        echo "Role Id = ". $role->role_id ."<br>";
        echo "Role Nama = ". $role->role_name ."<br>";
        echo "Role Description = ". $role->role_description ."<br>";
        echo "Role Status = ". $role->role_status ."<br><br>";
    }

?>