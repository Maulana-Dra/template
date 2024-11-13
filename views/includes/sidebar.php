<div class="w-64 bg-gray-800 text-gray-100 h-screen">
    <div class="p-4 font-bold text-lg">Menu</div>
    <ul class="mt-4 space-y-2">
        <?php 

        // Mendapatkan role_id dari session
        $role_id = $_SESSION['role_id'] ?? null; 

        // Sidebar untuk Admin (role_id 1)
        if ($role_id == 1) { 
        ?>

            <li class="group">
                <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer group-hover:bg-gray-700">
                    <a href="index.php?modul=role">Master Data Role</a>
                </div>
            </li>

            <li class="group">
                <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer group-hover:bg-gray-700">
                    <a href="index.php?modul=user">Master Data User</a>
                </div>
            </li>

            <li class="group">
                <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer group-hover:bg-gray-700">
                    <a href="index.php?modul=barang">Master Data Barang</a>
                </div>
            </li>

            <li class="group">
                <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer group-hover:bg-gray-700">Menu Transaksi</div>
                <ul class="ml-4 space-y-1 hidden group-hover:block">
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <a href="index.php?modul=transaksi">List Transaksi</a>
                    </li>
                </ul>
            </li>

        <?php 
        // Sidebar untuk Kasir (role_id 3)
        } elseif ($role_id == 3) { 
        ?>
            <li class="group">
                <div class="px-4 py-2 hover:bg-gray-700 cursor-pointer group-hover:bg-gray-700">Menu Transaksi</div>
                <ul class="ml-4 space-y-1 hidden group-hover:block">
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <a href="index.php?modul=transaksi&fitur=add">Insert Transaksi</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <a href="index.php?modul=transaksi">List Transaksi</a>
                    </li>
                </ul>
            </li>
        <?php 
        } 
        ?>
    </ul>
</div>