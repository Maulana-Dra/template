<?php 
require 'model/role_model1.php';

$obj_mobil = [];
$obj_mobil[] = new User(1,"Toyota Camry","Sedan","4-Silinder","Maulana");
$obj_mobil[] = new User(2,"Honda Civic","Sedan/Hatchback", "4-Silinder","Indah");
$obj_mobil[] = new User(3,"Tesla Model 3","Sedan", "Listrik","Muthe");

    foreach($obj_mobil as $mobils){ 
        //testr
    echo "ID Mobil: ".$mobils->mobil_id."<br>";
    echo "Nama Mobil: ".$mobils->mobil_name."<br>";
    echo "Description Mobil: ".$mobils->mobil_tipe."<br>";
    echo "status Mobil: ".$mobils->mobil_mesin."<br>";
    echo $mobils->user()."<br>"; 

    echo "<br>";
    }
   
?>