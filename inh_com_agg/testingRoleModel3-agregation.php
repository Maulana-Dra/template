<?php 
require 'model/role_model3.php';

$mobil = new MobilModel();

$mobil->AddUser("Toyota Camry","Sedan","4-Silinder","Maulana");
$mobil->AddUser("Honda Civic","Sedan/Hatchback", "4-Silinder","Indah");
$mobil->AddUser("Tesla Model 3","Sedan", "Listrik","Muthe");


foreach  ($mobil->listMobil as $mobil) {
    $mobil->CetakPengguna();
    echo "<br>";
}

?>