<div class="w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-gray-100 h-screen shadow-lg">
    <div class="p-4 font-bold text-xl text-center tracking-wide border-b border-gray-700">Menu</div>
    <ul class="mt-4 space-y-2">
        <?php 

        // Mendapatkan role_id dari session
        $role_id = $_SESSION['role_id'] ?? null; 

        // Sidebar untuk Admin (role_id 1)
        if ($role_id == 1) { 
        ?>

            <li class="group">
                <div class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200 group-hover:bg-gray-700">
                    <i class="fas fa-user-shield mr-3"></i>
                    <a href="index.php?modul=role" class="flex-1">Master Data Role</a>
                </div>
            </li>

            <li class="group">
                <div class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200 group-hover:bg-gray-700">
                    <i class="fas fa-users mr-3"></i>
                    <a href="index.php?modul=user" class="flex-1">Master Data User</a>
                </div>
            </li>

            <li class="group">
                <div class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200 group-hover:bg-gray-700">
                    <i class="fas fa-box-open mr-3"></i>
                    <a href="index.php?modul=barang" class="flex-1">Master Data Barang</a>
                </div>
            </li>

            <li class="group">
                <div class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200 group-hover:bg-gray-700">
                    <i class="fas fa-exchange-alt mr-3"></i>
                    <span class="flex-1">Menu Transaksi</span>
                </div>
                <ul class="ml-8 space-y-1 hidden group-hover:block">
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200">
                        <i class="fas fa-list mr-3"></i>
                        <a href="index.php?modul=transaksi" class="flex-1">List Transaksi</a>
                    </li>
                </ul>
            </li>

        <?php 
        // Sidebar untuk Kasir (role_id 3)
        } elseif ($role_id == 3) { 
        ?>
            <li class="group">
                <div class="flex items-center px-4 py-3 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200 group-hover:bg-gray-700">
                    <i class="fas fa-exchange-alt mr-3"></i>
                    <span class="flex-1">Menu Transaksi</span>
                </div>
                <ul class="ml-8 space-y-1 hidden group-hover:block">
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200">
                        <i class="fas fa-plus mr-3"></i>
                        <a href="index.php?modul=transaksi&fitur=add" class="flex-1">Insert Transaksi</a>
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 rounded-lg cursor-pointer transition-all duration-200">
                        <i class="fas fa-list mr-3"></i>
                        <a href="index.php?modul=transaksi" class="flex-1">List Transaksi</a>
                    </li>
                </ul>
            </li>
        <?php 
        } 
        ?>
    </ul>
</div>

<!-- Pastikan untuk menyertakan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
