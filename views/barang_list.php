<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 to-blue-200 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Container Utama -->
            <div class="container mx-auto">
                <!-- Button untuk menambahkan Barang baru -->
                <div class="flex justify-end mb-4">
                    <button class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                        <a href="index.php?modul=barang&fitur=input">Insert New Barang</a>
                    </button>
                </div>

                <!-- Tabel Barang -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/12 py-4 px-6 font-semibold text-sm uppercase tracking-wider text-center">ID</th>
                                <th class="w-1/4 py-4 px-6 font-semibold text-sm uppercase tracking-wider text-center">Nama</th>
                                <th class="w-1/4 py-4 px-6 font-semibold text-sm uppercase tracking-wider text-center">Harga</th>
                                <th class="w-1/6 py-4 px-6 font-semibold text-sm uppercase tracking-wider text-center">Stok</th>
                                <th class="w-1/6 py-4 px-6 font-semibold text-sm uppercase tracking-wider text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                            <?php foreach($barangs as $barang) { ?>
                                <tr class="text-center hover:bg-gray-100 transition-colors duration-200">
                                    <td class="py-4 px-6 text-blue-600 font-semibold"><?php echo htmlspecialchars($barang->id) ?></td>
                                    <td class="py-4 px-6"><?php echo htmlspecialchars($barang->nama) ?></td>
                                    <td class="py-4 px-6"><?php echo htmlspecialchars(number_format($barang->harga, 0, ',', '.')) ?></td>
                                    <td class="py-4 px-6"><?php echo htmlspecialchars($barang->stok) ?></td>
                                    <td class="py-4 px-6">
                                        <a href="index.php?modul=barang&fitur=edit&id=<?php echo $barang->id ?>">
                                            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-200">
                                                Update
                                            </button>
                                        </a>
                                        <a href="index.php?modul=barang&fitur=delete&id=<?php echo $barang->id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-200">
                                                Delete
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
